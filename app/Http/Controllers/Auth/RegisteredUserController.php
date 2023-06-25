<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Restaurant;
use App\Models\Tag;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Welcome',[
            'showRegister' => true,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'id' => Str::random(10),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //create restaurant by default for new user
        $restaurant = [
            'id' => Str::random(10),
            'user_id' => $user->id,
            'name' => $request->name . ' Restaurant',
            'table_amount' => 10,
            'bg_img_url' => 'default/restaurant.jpg',
            'logo_url' => 'default/logo.jpg',
            'khqr_url' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80',
            'home_address' => '123',
            'street_address' => '45 Street',
            'commune' => 'Phsar Doeum Thkov',
            'district' => 'Chamkarmon',
        ];
        $restaurant['qr_code_url'] = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=' . $_SERVER['HTTP_ORIGIN'] . '/restaurants/' . $restaurant['id'];
        Restaurant::create($restaurant);

        $tag = [
            'id' => Str::random(10),
            'name' => 'Main menu',
            'restaurant_id' => $restaurant['id'],
            'is_available' => true,
        ];
        Tag::create($tag);

        $category = [
            'id' => Str::random(10),
            'name' => 'Seafood',
            'bg_img_url' => 'default/category.jpg',
            'restaurant_id' => $restaurant['id'],
            'tag_id' => $tag['id'],
            'is_available' => true,
        ];
        Category::create($category);

        $item = [
            'id' => Str::random(10),
            'user_id' => $user->id,
            'category_id' => $category['id'],
            'name' => 'Crab',
            'price' => 4.5,
            'description' => 'Delicious crab',
            'img_url' => 'default/item.jpg',
            'is_available' => true,
        ];
        Item::create($item);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
