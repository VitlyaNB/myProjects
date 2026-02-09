@extends('layouts.app')

@section('content')
<div class="container">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="header-content">
                        <h2>Интересы пользователя: {{ $user->name }}</h2>
                        <p>{{ $user->email }}</p>
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                            ← Назад к списку пользователей
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    @if($interests->count() > 0)
                        <div class="interests-list">
                            @foreach($interests as $interest)
                                <div class="interest-item">
                                    <div class="interest-icon">!</div>
                                    <div class="interest-content">
                                        <div class="interest-name">{{ $interest->name }}</div>
                                        <div class="interest-date">
                                            Добавлен: {{ $interest->created_at->format('d.m.Y H:i') }}
                                        </div>
                                        @if($interest->updated_at != $interest->created_at)
                                            <div class="interest-updated">
                                                Обновлен: {{ $interest->updated_at->format('d.m.Y H:i') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="stats">
                            @csrf
                            <div class="stat-item">
                                <span class="stat-value">{{ $interests->count() }}</span>
                                <span class="stat-label">Всего интересов</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">{{ $interests->where('created_at', '>=', today())->count() }}</span>
                                <span class="stat-label">Добавлено сегодня</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">{{ $interests->where('created_at', '>=', now()->startOfMonth())->count() }}</span>
                                <span class="stat-label">За этот месяц</span>
                            </div>
                        </div>
                    @else
                        <div class="empty-state">
                            <h3>У пользователя пока нет интересов</h3>
                            <p>Пользователь еще не добавил ни одного интереса</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-bottom: none;
        padding: 30px;
    }

    .header-content h2 {
        margin: 0 0 5px 0;
        font-size: 1.8rem;
        font-weight: 600;
    }

    .header-content p {
        margin: 0 0 15px 0;
        opacity: 0.9;
    }

    .btn-secondary {
        background: rgba(255,255,255,0.2);
        color: white;
        border: 1px solid rgba(255,255,255,0.3);
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-secondary:hover {
        background: rgba(255,255,255,0.3);
        color: white;
        text-decoration: none;
    }

    .card-body {
        padding: 30px;
    }

    .interests-list {
        margin-bottom: 30px;
    }

    .interest-item {
        background: #f8f9ff;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 20px;
        border-left: 5px solid #667eea;
        transition: all 0.3s;
    }

    .interest-item:hover {
        transform: translateX(5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .interest-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .interest-content {
        flex: 1;
    }

    .interest-name {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .interest-date {
        font-size: 0.9rem;
        color: #888;
        margin-bottom: 3px;
    }

    .interest-updated {
        font-size: 0.85rem;
        color: #999;
        font-style: italic;
    }

    .stats {
        display: flex;
        justify-content: space-around;
        background: #f8f9ff;
        border-radius: 15px;
        padding: 20px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #667eea;
        display: block;
    }

    .stat-label {
        color: #666;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #888;
    }

    .empty-state h3 {
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .interest-item {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }

        .stats {
            flex-direction: column;
            gap: 20px;
        }

        .header-content {
            text-align: center;
        }
    }
</style>
@endsection
