
        let currentTransactionId = null;
        const assetContainer = document.getElementById('asset-list-container');

        function selectProject(id, title, client) {
            currentTransactionId = id;
            document.getElementById('empty-state').classList.add('hidden');
            document.getElementById('active-project-title').innerText = "Project " + title;
            document.getElementById('active-client-name').innerText = "Client: " + client;

            document.querySelectorAll('.project-link').forEach(btn => btn.classList.remove('bg-white/10', 'border-l-4', 'border-purple-500'));
            document.getElementById('project-btn-' + id).classList.add('bg-white/10', 'border-l-4', 'border-purple-500');

            loadProjectAssets();
        }

        function loadProjectAssets() {
            if (!currentTransactionId) return;
            fetch('/api/project-assets/' + currentTransactionId)
                .then(res => res.json())
                .then(data => {
                    assetContainer.innerHTML = '';
                    if (data.length === 0) {
                        assetContainer.innerHTML = `
                            <div class="text-center py-12 opacity-40 text-xs">
                                <i class="fa-solid fa-box-open text-3xl mb-2 block"></i> Belum ada file hasil produksi yang diunggah.
                            </div>`;
                        return;
                    }
                    data.forEach(file => {
                        assetContainer.innerHTML += `
                            <div class="flex justify-between items-center bg-white/5 border border-white/5 p-4 rounded-xl hover:border-purple-500/20 transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-purple-600/10 border border-purple-500/20 text-purple-400 rounded-xl flex items-center justify-center text-sm">
                                        <i class="fa-solid fa-file-zipper"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-white max-w-sm truncate">${file.file_name}</h4>
                                        <p class="text-[10px] text-gray-400 mt-0.5">Ukuran: ${file.file_size} | diunggah pada ${new Date(file.created_at).toLocaleDateString('id-ID')}</p>
                                    </div>
                                </div>
                                <a href="/storage/${file.file_path}" target="_blank" class="text-xs bg-white/5 hover:bg-white/10 px-3 py-1.5 rounded-lg border border-white/10 transition-all text-purple-400 font-medium">
                                    <i class="fa-solid fa-download"></i> Unduh
                                </a>
                            </div>`;
                    });
                });
        }

        function uploadAssetFile() {
            const input = document.getElementById('upload-input');
            if (input.files.length === 0 || !currentTransactionId) return;

            const formData = new FormData();
            formData.append('file', input.files[0]);
            formData.append('transaction_id', currentTransactionId);

            fetch('/admin/api/file-asset/upload', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === 'success') {
                    input.value = '';
                    loadProjectAssets();
                } else {
                    alert('Gagal mengunggah berkas.');
                }
            });
        }
