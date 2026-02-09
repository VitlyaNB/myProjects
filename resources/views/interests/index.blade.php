@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="header">
                        <h1 class="text-success">Мои интересы</h1>
                        <p>Добавляй и отслеживай свои увлечения</p>
                    </div>

                    <div class="add-interest">
                        <input type="text" id="interestInput" placeholder="Введите новый интерес..." maxlength="255">
                        <button class="add-btn" onclick="addInterest()">Добавить</button>
                    </div>

                    <div class="interests-list" id="interestsList">
                        @forelse($interests as $interest)
                            <div class="interest-item" data-id="{{ $interest->id }}">
                                <div class="interest-icon">!</div>
                                <div class="interest-content">
                                    <div class="interest-name">{{ $interest->name }}</div>
                                    <div class="interest-date">Добавлен: {{ $interest->created_at->format('d.m.Y') }}</div>
                                </div>
                                <div class="interest-actions">
                                    <button class="edit-btn" onclick="editInterest({{ $interest->id }}, '{{ addslashes($interest->name) }}')">
                                        Редактировать
                                    </button>
                                    <button class="delete-btn" onclick="deleteInterest({{ $interest->id }})">
                                        Удалить
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <h3>Пока нет интересов</h3>
                                <p>Добавьте первый интерес, используя поле выше</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="stats">
                        <div class="stat-item">
                            <span class="stat-value" id="totalCount">{{ $interests->count() }}</span>
                            <span class="stat-label">Всего интересов</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value" id="monthCount">0</span>
                            <span class="stat-label">За этот месяц</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value" id="todayCount">0</span>
                            <span class="stat-label">Сегодня</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Figtree', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
    }

    .header {
        text-align: center;
        color: white;
        margin-bottom: 40px;
        padding: 20px;
    }

    .header h1 {
        font-size: 2.8rem;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        backdrop-filter: blur(10px);
    }

    .add-interest {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }

    .add-interest input {
        flex: 1;
        padding: 15px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .add-interest input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .add-btn {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(67, 233, 123, 0.3);
    }

    .interests-list {
        max-height: 500px;
        overflow-y: auto;
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
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
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
    }

    .interest-actions {
        display: flex;
        gap: 10px;
    }

    .edit-btn, .delete-btn {
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }

    .edit-btn {
        background: #e3f2fd;
        color: #1976d2;
    }

    .edit-btn:hover {
        background: #bbdefb;
    }

    .delete-btn {
        background: #ffebee;
        color: #d32f2f;
    }

    .delete-btn:hover {
        background: #ffcdd2;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #888;
    }

    .stats {
        display: flex;
        justify-content: space-around;
        background: #f8f9ff;
        border-radius: 15px;
        padding: 20px;
        margin-top: 30px;
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

    .interests-list::-webkit-scrollbar {
        width: 8px;
    }

    .interests-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .interests-list::-webkit-scrollbar-thumb {
        background: #667eea;
        border-radius: 4px;
    }

    @media (max-width: 600px) {
        .add-interest {
            flex-direction: column;
        }

        .interest-item {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }

        .interest-actions {
            width: 100%;
            justify-content: center;
        }

        .stats {
            flex-direction: column;
            gap: 20px;
        }
    }

    .alert {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 1000;
        display: none;
    }

    .alert-success {
        background: #43e97b;
    }

    .alert-error {
        background: #d32f2f;
    }
</style>

<div id="alert" class="alert"></div>

<script>
let interests = @json($interests->toArray());

function showAlert(message, type = 'success') {
    const alert = document.getElementById('alert');
    alert.textContent = message;
    alert.className = `alert alert-${type}`;
    alert.style.display = 'block';

    setTimeout(() => {
        alert.style.display = 'none';
    }, 3000);
}

function addInterest() {
    const input = document.getElementById('interestInput');
    const name = input.value.trim();

    if (!name) {
        showAlert('Введите название интереса', 'error');
        return;
    }

    fetch('/interests', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ name: name })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            input.value = '';
            loadInterests();
            showAlert('Интерес добавлен!');
        } else {
            showAlert('Ошибка при добавлении интереса', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Ошибка при добавлении интереса', 'error');
    });
}

function editInterest(id, currentName) {
    const newName = prompt('Редактировать интерес:', currentName);

    if (newName && newName.trim() && newName.trim() !== currentName) {
        fetch(`/interests/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ name: newName.trim() })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadInterests();
                showAlert('Интерес обновлен!');
            } else {
                showAlert('Ошибка при обновлении интереса', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Ошибка при обновлении интереса', 'error');
        });
    }
}

function deleteInterest(id) {
    if (confirm('Удалить этот интерес?')) {
        fetch(`/interests/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadInterests();
                showAlert('Интерес удален!');
            } else {
                showAlert('Ошибка при удалении интереса', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Ошибка при удалении интереса', 'error');
        });
    }
}

function loadInterests() {
    // Load updated interests list via AJAX
    fetch('/interests/list')
    .then(response => response.json())
    .then(data => {
        updateInterestsList(data.interests);
    })
    .catch(error => {
        console.error('Error loading interests:', error);
    });

    // Load stats
    loadStats();
}

function loadStats() {
    fetch('/interests/stats')
    .then(response => response.json())
    .then(data => {
        document.getElementById('totalCount').textContent = data.total;
        document.getElementById('todayCount').textContent = data.today;
        document.getElementById('monthCount').textContent = data.month;
    })
    .catch(error => {
        console.error('Error loading stats:', error);
    });
}

function updateInterestsList(interests) {
    const interestsList = document.getElementById('interestsList');

    if (interests.length === 0) {
        interestsList.innerHTML = `
            <div class="empty-state">
                <h3>Пока нет интересов</h3>
                <p>Добавьте первый интерес, используя поле выше</p>
            </div>
        `;
        return;
    }

    interestsList.innerHTML = interests.map(interest => `
        <div class="interest-item" data-id="${interest.id}">
            <div class="interest-icon">!</div>
            <div class="interest-content">
                <div class="interest-name">${interest.name}</div>
                <div class="interest-date">Добавлен: ${new Date(interest.created_at).toLocaleDateString('ru-RU')}</div>
            </div>
            <div class="interest-actions">
                <button class="edit-btn" onclick="editInterest(${interest.id}, '${interest.name.replace(/'/g, "\\'")}')">
                    Редактировать
                </button>
                <button class="delete-btn" onclick="deleteInterest(${interest.id})">
                    Удалить
                </button>
            </div>
        </div>
    `).join('');
}

document.getElementById('interestInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        addInterest();
    }
});

// Load initial data
document.addEventListener('DOMContentLoaded', function() {
    loadInterests();
});
</script>
@endsection
