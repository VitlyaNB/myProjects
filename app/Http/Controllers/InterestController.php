<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Используем связь и наш scope для сортировки
        $interests = Auth::user()->interests()->recent()->get();

        return view('interests.index', compact('interests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Создаем через связь, ID юзера подставится сам
        $interest = Auth::user()->interests()->create([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'interest' => $interest
        ]);
    }

    public function update(Request $request, Interest $interest)
    {
        // Проверка прав (политики Access Policy были бы лучше, но оставим как есть)
        if ($interest->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $interest->update([
            'name' => $request->name,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(Interest $interest)
    {
        if ($interest->user_id !== Auth::id()) {
            abort(403);
        }

        $interest->delete();

        return response()->json(['success' => true]);
    }

    public function getStats()
    {
        $user = Auth::user();

        // Тут можно оптимизировать, но оставим логику подсчета
        $totalCount = $user->interests()->count();
        $todayCount = $user->interests()->whereDate('created_at', today())->count();
        $monthCount = $user->interests()->where('created_at', '>=', now()->startOfMonth())->count();

        return response()->json([
            'total' => $totalCount,
            'today' => $todayCount,
            'month' => $monthCount,
        ]);
    }

    public function getList()
    {
        $interests = Auth::user()->interests()->recent()->get();

        return response()->json([
            'interests' => $interests
        ]);
    }
}
