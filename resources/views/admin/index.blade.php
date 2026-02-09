@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Панель администратора</h2>
                    <p>Управление пользователями и их интересами</p>
                </div>

                <div class="card-body">
                    <div class="users-list">
                        @forelse($users as $user)
                            <div class="user-item">
                                <div class="user-info">
                                    <div class="user-name">
                                        <a href="{{ route('admin.user.interests', $user) }}" class="user-link">
                                            {{ $user->name }}
                                        </a>
                                    </div>
                                    <div class="user-email">{{ $user->email }}</div>
                                    <div class="user-stats">
                                        <span class="interests-count">
                                            Интересов: {{ $user->interests_count }}
                                        </span>
                                        <span class="registration-date">
                                            Регистрация: {{ $user->created_at->format('d.m.Y') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="user-actions">
                                    <a href="{{ route('admin.user.interests', $user) }}" class="btn btn-primary btn-sm">
                                        Просмотреть интересы
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <h3>Нет зарегистрированных пользователей</h3>
                            </div>
                        @endforelse
                    </div>

                    <div class="stats-summary">
                        <div class="stat-card">
                            <div class="stat-number">{{ $users->count() }}</div>
                            <div class="stat-label">Всего пользователей</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ $users->sum('interests_count') }}</div>
                            <div class="stat-label">Всего интересов</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ $users->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                            <div class="stat-label">Новых пользователей в этом месяце</div>
                        </div>
                    </div>
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

    .card-header h2 {
        margin: 0;
        font-size: 2rem;
        font-weight: 600;
    }

    .card-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }

    .card-body {
        padding: 30px;
    }

    .users-list {
        margin-bottom: 40px;
    }

    .user-item {
        background: #f8f9ff;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-left: 5px solid #667eea;
        transition: all 0.3s;
    }

    .user-item:hover {
        transform: translateX(5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .user-info {
        flex: 1;
    }

    .user-name {
        margin-bottom: 5px;
    }

    .user-link {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        text-decoration: none;
        transition: color 0.2s;
    }

    .user-link:hover {
        color: #667eea;
    }

    .user-email {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 8px;
    }

    .user-stats {
        display: flex;
        gap: 20px;
        font-size: 0.9rem;
        color: #888;
    }

    .user-actions {
        flex-shrink: 0;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #888;
    }

    .stats-summary {
        display: flex;
        justify-content: space-around;
        background: #f8f9ff;
        border-radius: 15px;
        padding: 30px;
        gap: 20px;
    }

    .stat-card {
        text-align: center;
        flex: 1;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #667eea;
        display: block;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.3;
    }

    @media (max-width: 768px) {
        .user-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .user-actions {
            width: 100%;
        }

        .btn {
            width: 100%;
            text-align: center;
        }

        .stats-summary {
            flex-direction: column;
            gap: 20px;
        }

        .user-stats {
            flex-direction: column;
            gap: 5px;
        }
    }
</style>
@endsection