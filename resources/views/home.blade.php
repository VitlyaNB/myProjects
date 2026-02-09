<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои интересы</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
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
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Мои интересы</h1>
        <p>Добавляй и отслеживай свои увлечения</p>
    </div>

    <div class="card">
        <div class="add-interest">
            <input type="text" id="interestInput" placeholder="Введите новый интерес...">
            <button class="add-btn" onclick="addInterest()">Добавить</button>
        </div>

        <div class="interests-list" id="interestsList"></div>

        <div class="stats">
            <div class="stat-item">
                <span class="stat-value" id="totalCount">0</span>
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

<script>
    let interests = JSON.parse(localStorage.getItem('interests')) || [];
    let idCounter = parseInt(localStorage.getItem('idCounter')) || 1;

    function formatDate(date) {
        return date.toLocaleDateString('ru-RU', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    }

    function updateStats() {
        const today = new Date().toDateString();
        const thisMonth = new Date().getMonth();
        const thisYear = new Date().getFullYear();

        const todayCount = interests.filter(i =>
            new Date(i.date).toDateString() === today
        ).length;

        const monthCount = interests.filter(i => {
            const d = new Date(i.date);
            return d.getMonth() === thisMonth && d.getFullYear() === thisYear;
        }).length;

        document.getElementById('totalCount').textContent = interests.length;
        document.getElementById('todayCount').textContent = todayCount;
        document.getElementById('monthCount').textContent = monthCount;
    }

    function addInterest() {
        const input = document.getElementById('interestInput');
        const name = input.value.trim();

        if (!name) {
            alert('Введите название интереса');
            return;
        }

        const interest = {
            id: idCounter++,
            name: name,
            date: new Date().toISOString()
        };

        interests.push(interest);
        saveToLocalStorage();
        renderInterests();

        input.value = '';
        input.focus();
    }

    function editInterest(id) {
        const interest = interests.find(i => i.id === id);
        const newName = prompt('Редактировать интерес:', interest.name);

        if (newName && newName.trim()) {
            interest.name = newName.trim();
            saveToLocalStorage();
            renderInterests();
        }
    }

    function deleteInterest(id) {
        if (confirm('Удалить этот интерес?')) {
            interests = interests.filter(i => i.id !== id);
            saveToLocalStorage();
            renderInterests();
        }
    }

    function saveToLocalStorage() {
        localStorage.setItem('interests', JSON.stringify(interests));
        localStorage.setItem('idCounter', idCounter);
    }

    function renderInterests() {
        const container = document.getElementById('interestsList');

        if (interests.length === 0) {
            container.innerHTML = `
                <div class="empty-state">
                    <h3>Пока нет интересов</h3>
                    <p>Добавьте первый интерес, используя поле выше</p>
                </div>`;
        } else {
            container.innerHTML = interests.map(interest => `
                <div class="interest-item">
                    <div class="interest-icon">!</div>
                    <div class="interest-content">
                        <div class="interest-name">${interest.name}</div>
                        <div class="interest-date">Добавлен: ${formatDate(new Date(interest.date))}</div>
                    </div>
                    <div class="interest-actions">
                        <button class="edit-btn" onclick="editInterest(${interest.id})">
                            Редактировать
                        </button>
                        <button class="delete-btn" onclick="deleteInterest(${interest.id})">
                            Удалить
                        </button>
                    </div>
                </div>
            `).join('');
        }

        updateStats();
    }

    document.getElementById('interestInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            addInterest();
        }
    });

    renderInterests();
</script>
</body>
</html>
