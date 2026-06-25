document.addEventListener('DOMContentLoaded', () => {
    // Inisialisasi data task (Read dari localStorage atau dummy data)
    let tasks = JSON.parse(localStorage.getItem('identra_tasks')) || [
        { id: 1, text: "Slicing UI Dashboard Admin", completed: true },
        { id: 2, text: "Integrasi API Kurs Mata Uang", completed: false }
    ];

    const input = document.getElementById('todo-input');
    const addBtn = document.getElementById('todo-add-btn');
    const listContainer = document.getElementById('todo-list');
    const statsLabel = document.getElementById('task-stats');

    function renderTasks() {
        if (!listContainer) return;

        if (tasks.length === 0) {
            listContainer.innerHTML = `<p class="col-span-2 text-center text-xs opacity-30 py-4 italic">Belum ada milestone yang ditambahkan.</p>`;
            statsLabel.innerText = `0 Tasks Remaining`;
            return;
        }

        // Menggunakan .map() untuk transformasi data array ke HTML
        listContainer.innerHTML = tasks.map(task => `
            <div class="flex justify-between items-center bg-white/5 p-4 rounded-xl border ${task.completed ? 'border-green-500/20' : 'border-white/5'} transition-all group">
                <div class="flex items-center gap-3">
                    <button onclick="toggleTask(${task.id})" class="w-5 h-5 rounded-md border border-white/20 ${task.completed ? 'bg-green-500 border-green-500' : 'hover:border-id-purple'} flex items-center justify-center transition-all">
                        ${task.completed ? '<i class="fa-solid fa-check text-[10px] text-white"></i>' : ''}
                    </button>
                    <span class="text-xs font-medium ${task.completed ? 'line-through opacity-30' : 'text-white/80'}">${task.text}</span>
                </div>
                <button onclick="deleteTask(${task.id})" class="text-white/20 hover:text-red-500 transition-colors opacity-0 group-hover:opacity-100">
                    <i class="fa-solid fa-trash-can text-[10px]"></i>
                </button>
            </div>
        `).join('');

        // Menggunakan .filter() untuk menghitung jumlah tugas sisa
        const remaining = tasks.filter(t => !t.completed).length;
        statsLabel.innerText = `${remaining} Tasks Remaining`;

        // Simpan ke LocalStorage agar data persisten
        localStorage.setItem('identra_tasks', JSON.stringify(tasks));
    }

    // CREATE: Menambahkan tugas baru
    addBtn.addEventListener('click', () => {
        const text = input.value.trim();
        if (text) {
            tasks.push({ id: Date.now(), text: text, completed: false });
            input.value = '';
            renderTasks();
        }
    });

    // Handle tombol enter pada input
    input.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') addBtn.click();
    });

    // UPDATE: Menandai tugas selesai (Toggle)
    window.toggleTask = function(id) {
        tasks = tasks.map(task => {
            if (task.id === id) return { ...task, completed: !task.completed };
            return task;
        });
        renderTasks();
    };

    // DELETE: Menghapus tugas
    window.deleteTask = function(id) {
        tasks = tasks.filter(task => task.id !== id);
        renderTasks();
    };

    renderTasks();
});