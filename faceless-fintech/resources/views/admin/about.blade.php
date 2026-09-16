@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h3 class="fw-bold mb-3">About Remedy Technology</h3>
                    <p class="text-muted">Professional PHP Script Development & Support Services</p>
                </div>

                <x-danger-alert />
                <x-success-alert />

                <!-- Hero Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow-lg border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="card-body text-center text-white py-5">
                                <div class="mb-4">
                                    <i class="fas fa-code fa-4x mb-3 opacity-75"></i>
                                </div>
                                <h1 class="display-4 fw-bold mb-3">Remedy Technology</h1>
                                <p class="lead mb-4">Expert Laravel PHP Script Development & Professional Support Services</p>
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <p class="mb-4">We specialize in creating custom Laravel PHP applications, providing professional installation services, and delivering ongoing support for businesses worldwide.</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center gap-3 flex-wrap">
                                    <a href="https://t.me/+heFFLpE7w5RjZjQ0" target="_blank" class="btn btn-light btn-lg px-4">
                                        <i class="fab fa-telegram me-2"></i>Get Support
                                    </a>
                                    <a href="https://codesremedy.com/" target="_blank" class="btn btn-outline-light btn-lg px-4">
                                        <i class="fas fa-globe me-2"></i>Visit Website
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services Grid -->
                <div class="row g-4">
                    <!-- Custom Development -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-0 hover-shadow-lg transition-all">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle" style="width: 80px; height: 80px;">
                                        <i class="fas fa-code text-primary fa-2x"></i>
                                    </div>
                                </div>
                                <h5 class="card-title fw-bold text-dark">Custom Development</h5>
                                <p class="card-text text-muted small">Laravel PHP Script Development tailored to your business needs</p>
                                <div class="mt-auto">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">Custom Solutions</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Installation Service -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-0 hover-shadow-lg transition-all">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle" style="width: 80px; height: 80px;">
                                        <i class="fas fa-cogs text-success fa-2x"></i>
                                    </div>
                                </div>
                                <h5 class="card-title fw-bold text-dark">Installation & Setup</h5>
                                <p class="card-text text-muted small">Professional script installation and server configuration</p>
                                <div class="mt-auto">
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">Quick Setup</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Support & Updates -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-0 hover-shadow-lg transition-all">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-circle" style="width: 80px; height: 80px;">
                                        <i class="fas fa-life-ring text-warning fa-2x"></i>
                                    </div>
                                </div>
                                <h5 class="card-title fw-bold text-dark">Lifetime Support</h5>
                                <p class="card-text text-muted small">Ongoing support, updates, and security enhancements</p>
                                <div class="mt-auto">
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">24/7 Support</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customization -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-0 hover-shadow-lg transition-all">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-info bg-opacity-10 rounded-circle" style="width: 80px; height: 80px;">
                                        <i class="fas fa-palette text-info fa-2x"></i>
                                    </div>
                                </div>
                                <h5 class="card-title fw-bold text-dark">Website Customization</h5>
                                <p class="card-text text-muted small">Custom branding and UI/UX design enhancements</p>
                                <div class="mt-auto">
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">Custom Design</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Services -->
                <div class="row mt-5">
                    <!-- Custom Laravel Development -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-primary text-white border-0">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-laptop-code me-2"></i>Custom Laravel PHP Script Development
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-3">Need a unique feature or a custom-built Laravel PHP script? Our expert developers can modify existing scripts or create brand-new solutions to fit your business needs.</p>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h6 class="fw-bold text-dark">Specializations:</h6>
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="fas fa-bitcoin text-warning me-2"></i>Bitcoin Investment Platforms</li>
                                            <li class="mb-2"><i class="fas fa-university text-primary me-2"></i>Online Banking Systems</li>
                                            <li class="mb-2"><i class="fas fa-exchange-alt text-success me-2"></i>Crypto Exchange Platforms</li>
                                            <li class="mb-2"><i class="fas fa-shipping-fast text-info me-2"></i>Courier Tracking Software</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-success">✅ Custom Feature Integration</span>
                                    <span class="badge bg-success">✅ Fully Responsive & Secure</span>
                                    <span class="badge bg-success">✅ Fast Turnaround</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Installation Service -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-success text-white border-0">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-server me-2 text-white"></i>Script Installation & Setup Service
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-3">Not familiar with server setups or script installations? Let our team handle everything! We offer professional script installation services.</p>

                                <div class="mb-3">
                                    <h6 class="fw-bold text-dark">What's Included:</h6>
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Quick & Secure Setup</li>
                                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Database Configuration</li>
                                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Bug Fixes & Optimization</li>
                                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>SSL Certificate Setup</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info border-0 mb-0">
                                    <i class="fas fa-info-circle me-2 text white"></i>
                                    <strong>Hassle-Free:</strong> Start using your script without any technical headaches!
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lifetime Support -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-warning text-dark border-0">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-shield-alt me-2 text-white"></i>Lifetime Support & Updates
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-3">We provide lifetime support and periodic updates for our PHP scripts, ensuring they stay secure, fast, and compatible with the latest technologies.</p>

                                <div class="mb-3">
                                    <h6 class="fw-bold text-dark">Support Includes:</h6>
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><i class="fas fa-tools text-primary me-2"></i>Technical Support for Minor Issues</li>
                                                <li class="mb-2"><i class="fas fa-bug text-danger me-2"></i>Bug Fixes & Performance Enhancements</li>
                                                <li class="mb-2"><i class="fas fa-shield-alt text-success me-2"></i>Security & Feature Updates</li>
                                                <li class="mb-2"><i class="fas fa-comments text-info me-2"></i>Expert Guidance & Consultation</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-4 py-2 fs-6">Always Up-to-Date & Secure</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Website Customization -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-info text-white border-0">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-paint-brush me-2"></i>Website Customization & Branding
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-3">Want to give your website a professional and unique look? We offer custom branding and UI/UX enhancements to match your business identity.</p>

                                <div class="mb-3">
                                    <h6 class="fw-bold text-dark">Design Services:</h6>
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><i class="fas fa-palette text-primary me-2"></i>Custom Logo & Branding</li>
                                                <li class="mb-2"><i class="fas fa-mobile-alt text-success me-2"></i>UI/UX Enhancements</li>
                                                <li class="mb-2"><i class="fas fa-search text-warning me-2"></i>Mobile & SEO Optimization</li>
                                                <li class="mb-2"><i class="fas fa-eye text-info me-2"></i>Modern Responsive Design</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-success border-0 mb-0">
                                    <i class="fas fa-target me-2"></i>
                                    <strong>Goal:</strong> Create a website that truly represents your brand!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);">
                            <div class="card-body text-center text-white py-5">
                                <h3 class="fw-bold mb-4">Ready to Get Started?</h3>
                                <p class="lead mb-4">Contact us today for a personalized quote and consultation</p>

                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="p-3 bg-white rounded">
                                                    <i class="fab fa-telegram fa-2x mb-2 text-dark"></i>
                                                    <h6 class="fw-bold text-dark">Telegram Support</h6>
                                                    <a href="https://t.me/+heFFLpE7w5RjZjQ0" target="_blank" class="btn btn-primary btn-sm">Join Channel</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="p-3 bg-white rounded">
                                                    <i class="fas fa-globe fa-2x mb-2 text-dark"></i>
                                                    <h6 class="fw-bold text-dark">Visit Website</h6>
                                                    <a href="https://codesremedy.com/" target="_blank" class="btn btn-primary btn-sm">codesremedy.com</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="p-3 bg-white rounded">
                                                    <i class="fas fa-phone fa-2x mb-2 text-dark"></i>
                                                    <h6 class="fw-bold text-dark">Phone Support</h6>
                                                    <a href="https://t.me/+heFFLpE7w5RjZjQ0" class="btn btn-primary btn-sm"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-shadow-lg:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
        }

        .transition-all {
            transition: all 0.3s ease-in-out;
        }

        .card-header {
            border-bottom: none !important;
        }

        .badge {
            font-size: 0.75rem;
        }

        .alert {
            border-radius: 0.5rem;
        }
    </style>
@endsection
