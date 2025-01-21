@extends('manager.manager_dashboard')
@section('users')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <style>
        .large-checkbox {
            transform: scale(1.5);
        }
    </style>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bxs-home-circle"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Download multiple files</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                </div>
            </div>
        </div>
        <div class="container">
            <form id="fetch-files-form" class="mb-3">
                <div class="mb-3">
                    <label for="url" class="form-label"><b>Folder URL</b></label>
                    <input type="text" id="url" name="url" class="form-control" placeholder="Enter folder URL" required>
                </div>

                <!-- File Extension Checkboxes -->
                <div class="mb-3">
                    <label class="form-label">Select File Extensions</label>
                    <div class="d-flex flex-wrap">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="extension-upd" name="extensions[]"
                                   value=".upd">
                            <label class="form-check-label" for="extension-upd">.upd</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="extension-upm" name="extensions[]"
                                   value=".upm">
                            <label class="form-check-label" for="extension-upm">.upm</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="extension-apex" name="extensions[]"
                                   value=".apex">
                            <label class="form-check-label" for="extension-apex">.apex</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="extension-encrypted" name="extensions[]"
                                   value=".encrypted">
                            <label class="form-check-label" for="extension-encrypted">.encrypted</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Fetch Files</button>
            </form>


            <!-- Files Table -->
            <form id="download-zip-form" action="{{ route('files.downloadZip') }}" method="POST">
                @csrf
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col"><input type="checkbox" id="select-all"></th>
                        <th scope="col">File Name</th>
                        <th scope="col">Download Link</th>
                    </tr>
                    </thead>
                    <tbody id="file-list">
                    <tr>
                        <td colspan="3">No files fetched yet.</td>
                    </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success mt-3" id="download-btn" disabled>Download Selected as ZIP
                </button>
            </form>
        </div>


    </div>
    <script>
        const fetchFilesForm = document.getElementById('fetch-files-form');
        const fileListContainer = document.getElementById('file-list');
        const downloadBtn = document.getElementById('download-btn');
        const selectAllCheckbox = document.getElementById('select-all');

        // Fetch files
        fetchFilesForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const url = document.getElementById('url').value;

            // Get selected extensions
            const extensions = Array.from(document.querySelectorAll('input[name="extensions[]"]:checked'))
                .map(checkbox => checkbox.value);

            fileListContainer.innerHTML = '<tr><td colspan="3">Fetching files...</td></tr>';
            downloadBtn.disabled = true;

            try {
                const response = await axios.post('{{ route('files.fetch') }}', {url, extensions});
                const files = response.data;

                if (files.length) {
                    fileListContainer.innerHTML = files.map(file => `
                        <tr>
                            <td><input type="checkbox" name="files[]" value="${file.url}" class="file-checkbox"></td>
                            <td>${file.name}</td>
                            <td><a href="${file.url}" target="_blank">${file.url}</a></td>
                        </tr>
                    `).join('');
                    downloadBtn.disabled = false;
                } else {
                    fileListContainer.innerHTML = '<tr><td colspan="3">No files found.</td></tr>';
                }
            } catch (error) {
                fileListContainer.innerHTML = '<tr><td colspan="3">Error fetching files.</td></tr>';
            }
        });

        // Select all checkboxes
        selectAllCheckbox.addEventListener('change', (e) => {
            const checkboxes = document.querySelectorAll('.file-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
        });
    </script>
@endsection
