<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Testimonial;
use App\Models\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::with(['rentalPrice', 'specification'])->latest()->take(6)->get();
        $testimonials = Testimonial::latest()->take(3)->get();
        $faqs = Faq::all();

        return view('frontend.home', compact('cars', 'testimonials', 'faqs'));
    }

    public function cars()
    {
        $cars = Car::with(['rentalPrice', 'specification'])->latest()->paginate(12);
        return view('frontend.cars', compact('cars'));
    }

    public function carDetail($id)
    {
        $car = Car::with(['rentalPrice', 'specification'])->findOrFail($id);
        return view('frontend.car-detail', compact('car'));
    }

    // TAMBAHKAN METHOD INI
    public function units()
    {
        $cars = Car::with(['rentalPrice', 'specification'])->get();
        return view('frontend.units', compact('cars'));
    }
}