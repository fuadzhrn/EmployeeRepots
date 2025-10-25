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
            <a href="#">Home</a>
            <a href="#">Form Request</a>
            <a href="#">Login</a>
        </div>
        </div>
    </nav>
    <!--  start form input -->
    <section class="form-request" id="form-request">
    <div class="title-form-request">
        <h2>Form Request</h2>
        <p>Please fill in the request form below</p>
    </div>
    <div>
        <form action="#" method="POST" enctype="multipart/form-data">
            <!-- nama pengirim -->
            <div class="nama-pengirim">
                <label for="nama">Request Name</label>
                <input type="text" id="nama" name="nama" placeholder="Input Request Name" required>
            </div>
            <!-- nomor karyawan -->
             <div class="badge-nomor">
                <label for="nomor">Badge No</label>
                <input type="text" id="nomor" name="nomor" placeholder="Input Badge No" required>
            </div>
            <!-- kategori -->
             <div class="category">
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="">-- select category --</option>
                    <option value="data">Data</option>
                    <option value="support_system">Support System</option>
                    <option value="menu_system">Menu System</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="training"></option>
                </select>
             </div>
            <!-- description -->
             <div class="description">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Please describe your needs in detail..." required></textarea>
                </div>
                <!-- document supporting -->
                <div class="document-supporting">
                    <label for="document">Document Supporting</label>
                    <input type="file" id="document" name="document" required>
                </div>
                <!-- submit button -->
                <div class="submit-button">
                    <button type="submit"> Request</button>
                    </div>
              
                </label>
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
</body>
</html>