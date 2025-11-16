<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Tnc;
use App\Models\MessageTemplate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::with(['rentalPrice', 'specification'])->latest()->take(6)->get();
        $testimonials = Testimonial::latest()->take(5)->get();
        $faqs = Faq::take(5)->get();

        return Inertia::render('Home', compact('cars', 'testimonials', 'faqs'));
    }

    public function about()
    {
        return Inertia::render('About');
    }

    public function cars()
    {
        $cars = Car::with(['rentalPrice', 'specification'])->latest()->paginate(12);
        return view('frontend.cars', compact('cars'));
    }

    public function units()
    {
        $cars = Car::with(['rentalPrice', 'specification'])->get();
        return Inertia::render('Units', compact('cars'));
    }

    public function unitsDetail($id)
    {
        $cars = Car::with(['rentalPrice', 'specification'])->findOrFail($id);
        // ambil semua mobil kecuali mobil yang sedang dibuka
        $carsRekom = Car::with(['rentalPrice', 'specification'])
            ->where('id_mobil', '!=', $id)
            ->get();
        return Inertia::render('CarsDetail', compact('cars', 'carsRekom'));
    }

    public function review()
    {
        $testimonials = Testimonial::all();
        return Inertia::render('Review', compact('testimonials'));
    }

    public function tnc()
    {
        $tncs = Tnc::all();
        return Inertia::render('TermAndCond/TermSection', compact('tncs'));
    }

    public function faq()
    {
        $faqs = Faq::all();
        return Inertia::render('Faq', compact('faqs'));
    }
}
