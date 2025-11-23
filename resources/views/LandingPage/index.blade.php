<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    <!-- Google Fonts - Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Request Management System</title>
</head>
<body>
    <nav class="navbar-header">
        <div class="container-nav">
        <div class="logo-website">
            <img src="{{ asset('asset/logo_putihvale.png') }}" alt="Logo">
        </div>
        <div class="title-header">
                <span>Request Management System</span>
            </div>
        <div class="nav-links">
            <a href="#form-request">Form Request</a>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            @endif
            @if(auth()->check())
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: white; cursor: pointer; font-weight: 500; text-decoration: none;">Logout</button>
                </form>
            @else
                <a href="{{ route('auth.login.show') }}">Login</a>
            @endif
        </div>
        </div>
    </nav>
    <!--  start form input -->
    <section class="form-request" id="form-request">
    <div class="title-form-request">
        <h2>Form Request</h2>
        <p>Please fill in the request form below</p>
    </div>

    @if (session('success'))
        <div style="background: #d1e7dd; border-left: 4px solid #4ade80; padding: 12px 14px; border-radius: 6px; color: #0f5132; font-size: 13px; margin-bottom: 20px; animation: slideDown 0.5s ease-out; display: flex; align-items: center;">
            <span style="display: inline-block; margin-right: 8px; animation: checkmark 0.6s ease-out;">✅</span>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background: #fee; border-left: 4px solid #ff6b6b; padding: 12px 14px; border-radius: 6px; color: #c41e3a; font-size: 13px; margin-bottom: 20px; animation: slideDown 0.5s ease-out; display: flex; align-items: center;">
            <span style="display: inline-block; margin-right: 8px;">❌</span>
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background: #fee; border-left: 4px solid #ff6b6b; padding: 12px 14px; border-radius: 6px; color: #c41e3a; font-size: 13px; margin-bottom: 20px; animation: slideDown 0.5s ease-out;">
            <strong>Validasi Error:</strong>
            <ul style="margin-top: 8px; margin-bottom: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <form action="{{ route('request.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- nama pengirim -->
            <div class="nama-pengirim @error('nama') has-error @enderror">
                <label for="nama">Request Name</label>
                <input type="text" id="nama" name="nama" placeholder="Input Request Name" value="{{ old('nama') }}" required>
                @error('nama')<span style="color: #ef4444; font-size: 12px;">{{ $message }}</span>@enderror
            </div>
            <!-- nomor karyawan -->
             <div class="badge-nomor @error('nomor') has-error @enderror">
                <label for="nomor">Badge No</label>
                <input type="text" id="nomor" name="nomor" placeholder="Input Badge No" value="{{ old('nomor') }}" required>
                @error('nomor')<span style="color: #ef4444; font-size: 12px;">{{ $message }}</span>@enderror
            </div>
            <!-- kategori -->
             <div class="category @error('category') has-error @enderror">
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="">-- select category --</option>
                    <option value="data" {{ old('category') == 'data' ? 'selected' : '' }}>Data</option>
                    <option value="support_system" {{ old('category') == 'support_system' ? 'selected' : '' }}>Support System</option>
                    <option value="menu_system" {{ old('category') == 'menu_system' ? 'selected' : '' }}>Menu System</option>
                    <option value="maintenance" {{ old('category') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="training" {{ old('category') == 'training' ? 'selected' : '' }}>Training</option>
                </select>
                @error('category')<span style="color: #ef4444; font-size: 12px;">{{ $message }}</span>@enderror
             </div>
            <!-- description -->
             <div class="description @error('description') has-error @enderror">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Please describe your needs in detail..." required>{{ old('description') }}</textarea>
                @error('description')<span style="color: #ef4444; font-size: 12px;">{{ $message }}</span>@enderror
                </div>
                <!-- document supporting -->
                <div class="document-supporting @error('document') has-error @enderror">
                    <label for="document">Document Supporting (Max 2MB)</label>
                    <input type="file" id="document" name="document" required accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.txt,.zip">
                    
                    <!-- Custom File Upload UI -->
                    <div class="file-visual">
                        <div class="file-upload-icon">📄</div>
                        <div class="file-upload-text">
                            <span class="primary">Click or drag file here</span>
                            <span class="secondary">Supported formats: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG, TXT, ZIP</span>
                            <span class="file-size">Max size: 2MB</span>
                        </div>
                        <div class="file-name" id="fileName"></div>
                    </div>
                    
                    @error('document')<span style="color: #ef4444; font-size: 12px;">{{ $message }}</span>@enderror
                    <div class="file-error-msg" id="fileError"></div>
                </div>
                <!-- submit button -->
                <div class="submit-button">
                    <button type="submit">Submit Request</button>
                    </div>
             </div>
        </form>
    </div>
    </section>
    <!-- end form input -->
    <!-- start footer - creative redesign with teal matching navbar -->
    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="{{ asset('asset/logo_putihvale.png') }}" alt="Logo" width="100" height="auto">
            </div>
            <div class="footer-sections-group">
                <div class="footer-section footer-about">
                    <h3>Request Management</h3>
                    <p>Streamline your workflow with our intuitive request system. Submit, track, and resolve requests efficiently.</p>
                </div>
                <div class="footer-section footer-links">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#form-request">Submit Request</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
                <div class="footer-section footer-support">
                    <h4>Support</h4>
                    <div class="support-item">
                        <span class="support-icon">📧</span>
                        <div>
                            <strong>Email</strong>
                            <p>support@vale.example</p>
                        </div>
                    </div>
                    <div class="support-item">
                        <span class="support-icon">📞</span>
                        <div>
                            <strong>Phone</strong>
                            <p>+62 21 0000 000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-divider"></div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} VALE Request Management System. All rights reserved.</p>
            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <script src="{{ asset('asset/js/main.js') }}"></script>
    
    <script>
        // Handle file upload with validation
        const fileInput = document.getElementById('document');
        const fileVisual = document.querySelector('.file-visual');
        const fileName = document.getElementById('fileName');
        const fileError = document.getElementById('fileError');
        const MAX_SIZE = 2 * 1024 * 1024; // 2MB
        let isFileSelected = false; // Flag untuk track file selection state
        
        console.log('File upload script initialized', {fileInput, fileVisual, fileName, fileError});
        
        if (fileInput && fileVisual) {
            // Click to upload - hanya buka file dialog jika belum ada file
            fileVisual.addEventListener('click', function(e) {
                console.log('File visual clicked, isFileSelected:', isFileSelected);
                // Jika sudah ada file yang dipilih, jangan buka dialog (akan kembali ke file picker)
                if (isFileSelected) {
                    console.log('File already selected, skipping file picker');
                    return;
                }
                e.preventDefault();
                e.stopPropagation();
                console.log('Opening file picker');
                fileInput.click();
            });
            
            // Drag & drop
            fileVisual.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                fileVisual.style.borderColor = '#005f5a';
                fileVisual.style.background = 'linear-gradient(135deg,rgba(0,126,122,0.12),rgba(0,126,122,0.08))';
            });
            
            fileVisual.addEventListener('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                fileVisual.style.borderColor = '#007E7A';
                fileVisual.style.background = 'linear-gradient(135deg,rgba(0,126,122,0.04),rgba(0,126,122,0.02))';
            });
            
            fileVisual.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                fileVisual.style.borderColor = '#007E7A';
                fileVisual.style.background = 'linear-gradient(135deg,rgba(0,126,122,0.04),rgba(0,126,122,0.02))';
                
                const files = e.dataTransfer.files;
                if (files && files.length > 0) {
                    console.log('File dropped', {filename: files[0].name, size: files[0].size});
                    fileInput.files = files;
                    handleFileSelect();
                }
            });
            
            // File selection handler
            fileInput.addEventListener('change', function() {
                console.log('File input changed');
                handleFileSelect();
            });
            
            function handleFileSelect() {
                fileError.textContent = '';
                fileName.textContent = '';
                fileName.classList.remove('file-error');
                isFileSelected = false; // Reset flag
                
                if (!fileInput.files || fileInput.files.length === 0) {
                    console.log('No file selected');
                    isFileSelected = false;
                    return;
                }
                
                const file = fileInput.files[0];
                console.log('Processing file:', {name: file.name, size: file.size, type: file.type});
                
                // Check file size
                if (file.size > MAX_SIZE) {
                    fileName.textContent = '❌ File too large (max 2MB)';
                    fileName.classList.add('file-error');
                    fileError.textContent = 'File size exceeds 2MB limit';
                    fileInput.value = '';
                    isFileSelected = false;
                    console.log('File too large');
                    return;
                }
                
                // Check file type
                const allowedTypes = ['application/pdf', 'application/msword', 
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'image/jpeg', 'image/jpg', 'image/png', 'text/plain',
                    'application/zip', 'application/x-zip-compressed'];
                
                const allowedExtensions = ['.pdf', '.doc', '.docx', '.xls', '.xlsx', '.jpg', '.jpeg', '.png', '.txt', '.zip'];
                const fileExtension = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();
                
                console.log('File extension check:', {extension: fileExtension, isAllowed: allowedExtensions.includes(fileExtension)});
                
                if (!allowedExtensions.includes(fileExtension) && !allowedTypes.includes(file.type)) {
                    fileName.textContent = '❌ File format not allowed';
                    fileName.classList.add('file-error');
                    fileError.textContent = 'Allowed formats: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG, TXT, ZIP';
                    fileInput.value = '';
                    isFileSelected = false;
                    console.log('File format not allowed');
                    return;
                }
                
                // File OK - set flag dan tampilkan dengan animasi pulse
                isFileSelected = true;
                const fileSizeKB = (file.size / 1024).toFixed(2);
                fileName.textContent = '✓ ' + file.name + ' (' + fileSizeKB + ' KB)';
                fileName.classList.remove('file-error');
                fileName.style.animation = 'pulse 0.6s ease-out';
                console.log('File accepted:', {name: file.name, sizeKB: fileSizeKB});
            }
        } else {
            console.error('File upload elements not found!', {fileInput, fileVisual});
        }

        // Handle form submission dengan loading animation
        const form = document.querySelector('.form-request form');
        if (form) {
            form.addEventListener('submit', function(e) {
                console.log('Form submit event, isFileSelected:', isFileSelected);
                
                // Validasi bahwa ada file yang dipilih
                if (!fileInput.files || fileInput.files.length === 0) {
                    e.preventDefault();
                    fileError.textContent = 'Please select a file';
                    console.log('Form submit prevented: no file selected');
                    return;
                }

                // Tambahkan loading state ke button
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    const originalText = submitBtn.textContent;
                    submitBtn.innerHTML = '<span style="display: inline-block; animation: spin 1s linear infinite;">⏳</span> Uploading...';
                    console.log('Form submitting...');
                }
            });
        } else {
            console.error('Form not found!');
        }

        // Auto-reset form dan file state setelah submit sukses
        function resetUploadForm() {
            const successMsg = document.querySelector('div[style*="background: #d1e7dd"]');
            if (successMsg) {
                console.log('Success message detected, resetting form in 2 seconds');
                // Tunggu 2 detik sebelum reset untuk menampilkan success message
                setTimeout(() => {
                    if (form) {
                        form.reset();
                    }
                    fileName.textContent = '';
                    fileError.textContent = '';
                    isFileSelected = false;
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Submit Request';
                    }
                    console.log('Form reset completed');
                }, 2000);
            }
        }

        // Run reset jika ada success message saat page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');
            resetUploadForm();
        });
    </script>

    <style>
        @keyframes pulse {
            0% {
                opacity: 0;
                transform: scale(0.95);
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes checkmark {
            0% {
                opacity: 0;
                transform: scale(0) rotateZ(-45deg);
            }
            50% {
                transform: scale(1.2) rotateZ(10deg);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotateZ(0deg);
            }
        }

        .success-notification {
            animation: slideDown 0.5s ease-out;
        }

        button[type="submit"]:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
    </style>
</body>
</html>