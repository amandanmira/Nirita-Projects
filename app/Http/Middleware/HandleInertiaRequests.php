<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\MessageTemplate;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [

            // Data admin yang sedang login
            'admin' => $request->user() ? [
                'id' => $request->user()->id_admin,
                'username' => $request->user()->username,
                'email' => $request->user()->email,
            ] : null,

            // Flash messages untuk alert/notification
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'error' => fn() => $request->session()->get('error'),
            ],

            // Semua template tersedia sebagai array
            'waTemplates' => function () {
                return MessageTemplate::all()->map(function ($t) {
                    return [
                        'id' => $t->id_template,
                        'title' => $t->jenis_template ?? null,
                        'message' => $t->isi,
                        'phone' => preg_replace('/[^0-9]/', '', $t->no_telp_tujuan),
                        'link' => "https://wa.me/"
                            . preg_replace('/[^0-9]/', '', $t->no_telp_tujuan)
                            . "?text=" . urlencode($t->isi),
                    ];
                });
            },

        ]);
    }

    // protected function waLinkGenerator()
    // {
    //     $template = MessageTemplate::first();

    //     if (!$template) return null;

    //     $pesan = urlencode($template->isi);
    //     $nomor = preg_replace('/[^0-9]/', '', $template->no_telp_tujuan);

    //     return "https://wa.me/{$nomor}?text={$pesan}";
    // }
}
