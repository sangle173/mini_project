<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Downloader</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="p-5">
<div class="container">
    <h1>File Downloader</h1>
    <form id="url-form" class="mb-3">
        <div class="input-group">
            <input type="url" id="url-input" name="url" class="form-control" placeholder="Enter folder URL" required>
            <button type="submit" class="btn btn-primary">Fetch Files</button>
        </div>
    </form>

    <div id="files-section" style="display:none;">
        <h3>Files</h3>
        <form id="download-form">
            <div id="file-list" class="mb-3"></div>
            <button type="submit" class="btn btn-success">Download Selected</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('url-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const url = document.getElementById('url-input').value;

        try {
            const response = await axios.post('{{ route('file.fetch') }}', { url });
            const files = response.data.files;
            const fileList = document.getElementById('file-list');

            fileList.innerHTML = '';
            files.forEach(file => {
                fileList.innerHTML += `
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="files[]" value="${file}" id="${file}">
                            <label class="form-check-label" for="${file}">${file}</label>
                        </div>`;
            });

            document.getElementById('files-section').style.display = 'block';
        } catch (err) {
            alert('Error fetching files. Please try again.');
        }
    });

    document.getElementById('download-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        formData.append('url', document.getElementById('url-input').value);

        try {
            const response = await axios.post('{{ route('file.download') }}', formData, {
                responseType: 'blob'
            });
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'files.zip');
            document.body.appendChild(link);
            link.click();
            link.remove();
        } catch (err) {
            alert('Error downloading files. Please try again.');
        }
    });
</script>
</body>
</html>
