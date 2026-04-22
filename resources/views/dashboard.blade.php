<body>

    @include('layouts.navigation')

    <!-- ===== HERO ===== -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <div class="hero-title-vi">Virtual Imagination</div>
            <div class="hero-title-ps">PhotoStudio</div>
            <p class="hero-desc">
                <b>Virtual Imagination</b> adalah studio foto untuk berbagai kebutuhan produksi, mulai dari foto hingga video.
            </p>
            <p class="hero-desc">
                Kami juga menyediakan layanan kreatif seperti pembuatan konten dan kebutuhan visual lainnya.
            </p>
        </div>

        <div class="social-bar">
            <div class="social-bar-inner">
                <a href="#" target="_blank">
                    <!-- Instagram -->
                    <svg class="social-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                    INSTAGRAM
                </a>
                <a href="#" target="_blank">
                    <!-- YouTube -->
                    <svg class="social-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/>
                    </svg>
                    YOUTUBE
                </a>
                <a href="#" target="_blank">
                    <!-- LinkedIn -->
                    <svg class="social-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                    LINKEDIN
                </a>
                <a href="#" target="_blank">
                    <!-- TikTok -->
                    <svg class="social-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                    </svg>
                    TIK TOK
                </a>
            </div>
        </div>
    </section>

    <!-- ===== VISION & MISSION ===== -->
    <section class="vm-section">
        <div class="vm-inner">
            <div class="vm-left">
                <h2 class="vm-heading">Vision &<br>Mission</h2>
                <div class="vm-divider"></div>
                <p class="vm-body">
                    <b>Our vision</b> is to become a home for creative workers to express and bring their ideas to life. We aim to be a perfect place where people can create and fulfill the needs in the community of creative industry.
                </p>
                <p class="vm-body">
                    <b>Our mission</b> is to provide exquisite ambiance service for the sake of client's satisfaction towards the works of Belinsky Studio. Based on our name, Be Line To The Sky, which implies taking off to the sky, where creativity is limitless. Our job is to produce high quality audio visual output and represent uniqueness in every aspect.
                </p>
                <div class="vm-divider-bottom"></div>
            </div>

            <div class="vm-photos">
                <div class="vm-photo-top-left">
                    <img src="/images/vm1.png" alt="Vision Mission Photo 1">
                </div>
                <div class="vm-photo-top-right">
                    <img src="/images/vm2.png" alt="Vision Mission Photo 2">
                </div>
                <div class="vm-photo-bottom-center">
                    <img src="/images/vm3.png" alt="Vision Mission Photo 3" style="height:210px; object-fit:cover; border-radius:4px;">
                </div>
            </div>
        </div>
    </section>

     <!-- ===== CATEGORY SECTION ===== -->
    <section class="cat-section" id="category">
        <div class="cat-header">
            <h2 class="cat-title">Category</h2>
            <div class="cat-title-line"></div>
        </div>

        <div class="cat-grid">

            <!-- Card 1 -->
            <a class="cat-card" href="#cat-events" onclick="openCategory('cat-events', event)">
                <img src="{{ asset('images/cat-events.jpg') }}" alt="Photo Events" loading="lazy">
                <div class="cat-card-overlay"></div>
                <div class="cat-card-info">
                    <span class="cat-card-label">Photo Events</span>
                    <span class="cat-card-arrow">→</span>
                </div>
            </a>

            <!-- Card 2 -->
            <a class="cat-card" href="#cat-graduation" onclick="openCategory('cat-graduation', event)">
                <img src="{{ asset('images/cat-graduation.jpg') }}" alt="Photo Graduation" loading="lazy">
                <div class="cat-card-overlay"></div>
                <div class="cat-card-info">
                    <span class="cat-card-label">Photo Graduation</span>
                    <span class="cat-card-arrow">→</span>
                </div>
            </a>

            <!-- Card 3 -->
            <a class="cat-card" href="#cat-group" onclick="openCategory('cat-group', event)">
                <img src="{{ asset('images/cat-group.jpg') }}" alt="Photo Group" loading="lazy">
                <div class="cat-card-overlay"></div>
                <div class="cat-card-info">
                    <span class="cat-card-label">Photo Group</span>
                    <span class="cat-card-arrow">→</span>
                </div>
            </a>

            <!-- Card 4 -->
            <a class="cat-card" href="#cat-prewedding" onclick="openCategory('cat-prewedding', event)">
                <img src="{{ asset('images/cat-prewedding.jpg') }}" alt="Photo Prewedding" loading="lazy">
                <div class="cat-card-overlay"></div>
                <div class="cat-card-info">
                    <span class="cat-card-label">Photo Prewedding</span>
                    <span class="cat-card-arrow">→</span>
                </div>
            </a>

            <!-- Card 5 (wide) -->
            <a class="cat-card cat-card--wide" href="#cat-personal" onclick="openCategory('cat-personal', event)">
                <img src="{{ asset('images/cat-personal.jpg') }}" alt="Photo Personal" loading="lazy">
                <div class="cat-card-overlay"></div>
                <div class="cat-card-info">
                    <span class="cat-card-label">Photo Personal</span>
                    <span class="cat-card-arrow">→</span>
                </div>
            </a>

        </div>
    </section>

    <!-- ===== CATEGORY DETAIL DRAWER ===== -->
    <div class="cat-drawer-overlay" id="catDrawerOverlay" onclick="closeCategory()"></div>

    <div class="cat-drawer" id="catDrawer">

        <!-- Sticky top bar -->
        <div class="cat-drawer-topbar">
            <button class="cat-drawer-back" onclick="closeCategory()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali
            </button>
            <span class="cat-drawer-topbar-title" id="drawerTopTitle"></span>
        </div>

        <!-- Scrollable content -->
        <div class="cat-drawer-body" id="catDrawerBody">

            <!-- ======= DETAIL: PHOTO EVENTS ======= -->
            <div class="cat-detail" id="cat-events">
                <div class="cat-detail-hero">
                    <img src="{{ asset('images/cat-events.jpg') }}" alt="Photo Events">
                    <div class="cat-detail-hero-overlay">
                        <h1 class="cat-detail-hero-title">Photo Events</h1>
                    </div>
                </div>

                <div class="cat-detail-content">
                    <div class="cat-slider-wrap">
                        <button class="cat-slider-btn cat-slider-prev" onclick="slideMove('events', -1)">&#8592;</button>
                        <div class="cat-slider" id="slider-events">
                            <div class="cat-slide"><img src="{{ asset('images/events-1.jpg') }}" alt="Events 1"></div>
                            <div class="cat-slide"><img src="{{ asset('images/events-2.jpg') }}" alt="Events 2"></div>
                            <div class="cat-slide"><img src="{{ asset('images/events-3.jpg') }}" alt="Events 3"></div>
                        </div>
                        <button class="cat-slider-btn cat-slider-next" onclick="slideMove('events', 1)">&#8594;</button>
                        <div class="cat-slider-dots" id="dots-events">
                            <span class="cat-dot active" onclick="slideTo('events', 0)"></span>
                            <span class="cat-dot" onclick="slideTo('events', 1)"></span>
                            <span class="cat-dot" onclick="slideTo('events', 2)"></span>
                        </div>
                    </div>

                    <div class="cat-detail-info">
                        <div class="cat-detail-left">
                            <div class="cat-pricelist">
                                <h3 class="cat-info-heading">Pricelist</h3>
                                <p>6 hrs &nbsp;: Rp 2.300.000</p>
                                <p>8 hrs &nbsp;: Rp 3.000.000</p>
                                <p>10 hrs : Rp 3.700.000</p>
                            </div>
                            <div class="cat-hours">
                                <h3 class="cat-info-heading">Hours in studio</h3>
                                <p>Rp 400.000/hour</p>
                            </div>
                            <div class="cat-cta">
                                <a href="https://wa.me/6281514191380?text={{ urlencode('Halo, saya ingin booking paket foto di Virtual Imagination Photo Studio.') }}"
                                    target="_blank"
                                    class="btn-wa">
                                  <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                                <a href="/bookings/create" class="btn-booking">Booking</a>
                            </div>
                        </div>

                        <div class="cat-detail-right">
                            <div class="cat-equip-grid">
                                <div>
                                    <h3 class="cat-info-heading">Korean Mood Studio</h3>
                                    <p class="cat-equip-desc">3 thematic Korean backgrounds, inspired by the setup of Korean Drama Series</p>
                                    <p class="cat-equip-desc" style="margin-top:6px;">Our Beloved Summer</p>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Equipment list</h3>
                                    <ul class="cat-equip-list">
                                        <li>Lighting Godox DP400III (2 pcs)</li>
                                        <li>Trigger Wireless Flash</li>
                                        <li>Softbox with Grid (2pcs)</li>
                                        <li>Translucent Umbrella 101cm</li>
                                        <li>Light Stand (2pcs)</li>
                                        <li>Boom Stand with Weight Bag</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Additional lighting for video:</h3>
                                    <ul class="cat-equip-list">
                                        <li>Godox SL 150W</li>
                                        <li>Light Stand</li>
                                        <li>Softbox with Grid</li>
                                    </ul>
                                    <p class="cat-equip-price">200k/lighting</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======= DETAIL: PHOTO GRADUATION ======= -->
            <div class="cat-detail" id="cat-graduation">
                <div class="cat-detail-hero">
                    <img src="{{ asset('images/cat-graduation.jpg') }}" alt="Photo Graduation">
                    <div class="cat-detail-hero-overlay">
                        <h1 class="cat-detail-hero-title">Photo Graduation</h1>
                    </div>
                </div>

                <div class="cat-detail-content">
                    <div class="cat-slider-wrap">
                        <button class="cat-slider-btn cat-slider-prev" onclick="slideMove('graduation', -1)">&#8592;</button>
                        <div class="cat-slider" id="slider-graduation">
                            <div class="cat-slide"><img src="{{ asset('images/graduation-1.jpg') }}" alt="Graduation 1"></div>
                            <div class="cat-slide"><img src="{{ asset('images/graduation-2.jpg') }}" alt="Graduation 2"></div>
                            <div class="cat-slide"><img src="{{ asset('images/graduation-3.jpg') }}" alt="Graduation 3"></div>
                        </div>
                        <button class="cat-slider-btn cat-slider-next" onclick="slideMove('graduation', 1)">&#8594;</button>
                        <div class="cat-slider-dots" id="dots-graduation">
                            <span class="cat-dot active" onclick="slideTo('graduation', 0)"></span>
                            <span class="cat-dot" onclick="slideTo('graduation', 1)"></span>
                            <span class="cat-dot" onclick="slideTo('graduation', 2)"></span>
                        </div>
                    </div>

                    <div class="cat-detail-info">
                        <div class="cat-detail-left">
                            <div class="cat-pricelist">
                                <h3 class="cat-info-heading">Pricelist</h3>
                                <p>2 hrs &nbsp;: Rp 800.000</p>
                                <p>4 hrs &nbsp;: Rp 1.400.000</p>
                                <p>6 hrs &nbsp;: Rp 1.900.000</p>
                            </div>
                            <div class="cat-hours">
                                <h3 class="cat-info-heading">Hours in studio</h3>
                                <p>Rp 300.000/hour</p>
                            </div>
                            <div class="cat-cta">
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn-wa">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                                <a href="#booking" class="btn-booking">Booking</a>
                            </div>
                        </div>

                        <div class="cat-detail-right">
                            <div class="cat-equip-grid">
                                <div>
                                    <h3 class="cat-info-heading">Graduation Studio</h3>
                                    <p class="cat-equip-desc">Studio khusus sesi wisuda dengan backdrop elegan dan profesional.</p>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Equipment list</h3>
                                    <ul class="cat-equip-list">
                                        <li>Lighting Godox DP400III (2 pcs)</li>
                                        <li>Trigger Wireless Flash</li>
                                        <li>Softbox with Grid (2pcs)</li>
                                        <li>Reflector Board</li>
                                        <li>Light Stand (2pcs)</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Additional props:</h3>
                                    <ul class="cat-equip-list">
                                        <li>Graduation backdrop</li>
                                        <li>Flower stand</li>
                                        <li>Chair set</li>
                                    </ul>
                                    <p class="cat-equip-price">100k/props</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======= DETAIL: PHOTO GROUP ======= -->
            <div class="cat-detail" id="cat-group">
                <div class="cat-detail-hero">
                    <img src="{{ asset('images/cat-group.jpg') }}" alt="Photo Group">
                    <div class="cat-detail-hero-overlay">
                        <h1 class="cat-detail-hero-title">Photo Group</h1>
                    </div>
                </div>

                <div class="cat-detail-content">
                    <div class="cat-slider-wrap">
                        <button class="cat-slider-btn cat-slider-prev" onclick="slideMove('group', -1)">&#8592;</button>
                        <div class="cat-slider" id="slider-group">
                            <div class="cat-slide"><img src="{{ asset('images/group-1.jpg') }}" alt="Group 1"></div>
                            <div class="cat-slide"><img src="{{ asset('images/group-2.jpg') }}" alt="Group 2"></div>
                            <div class="cat-slide"><img src="{{ asset('images/group-3.jpg') }}" alt="Group 3"></div>
                        </div>
                        <button class="cat-slider-btn cat-slider-next" onclick="slideMove('group', 1)">&#8594;</button>
                        <div class="cat-slider-dots" id="dots-group">
                            <span class="cat-dot active" onclick="slideTo('group', 0)"></span>
                            <span class="cat-dot" onclick="slideTo('group', 1)"></span>
                            <span class="cat-dot" onclick="slideTo('group', 2)"></span>
                        </div>
                    </div>

                    <div class="cat-detail-info">
                        <div class="cat-detail-left">
                            <div class="cat-pricelist">
                                <h3 class="cat-info-heading">Pricelist</h3>
                                <p>4 hrs &nbsp;: Rp 1.500.000</p>
                                <p>6 hrs &nbsp;: Rp 2.000.000</p>
                                <p>8 hrs &nbsp;: Rp 2.500.000</p>
                            </div>
                            <div class="cat-hours">
                                <h3 class="cat-info-heading">Hours in studio</h3>
                                <p>Rp 350.000/hour</p>
                            </div>
                            <div class="cat-cta">
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn-wa">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                                <a href="#booking" class="btn-booking">Booking</a>
                            </div>
                        </div>

                        <div class="cat-detail-right">
                            <div class="cat-equip-grid">
                                <div>
                                    <h3 class="cat-info-heading">Group Studio</h3>
                                    <p class="cat-equip-desc">Ruang luas ideal untuk sesi foto grup, keluarga, atau tim dengan kapasitas hingga 20 orang.</p>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Equipment list</h3>
                                    <ul class="cat-equip-list">
                                        <li>Lighting Godox DP400III (3 pcs)</li>
                                        <li>Trigger Wireless Flash</li>
                                        <li>Softbox with Grid (3pcs)</li>
                                        <li>Translucent Umbrella 101cm</li>
                                        <li>Light Stand (3pcs)</li>
                                        <li>Boom Stand with Weight Bag</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Additional for video:</h3>
                                    <ul class="cat-equip-list">
                                        <li>Godox SL 150W</li>
                                        <li>Light Stand</li>
                                        <li>Softbox with Grid</li>
                                    </ul>
                                    <p class="cat-equip-price">200k/lighting</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======= DETAIL: PHOTO PREWEDDING ======= -->
            <div class="cat-detail" id="cat-prewedding">
                <div class="cat-detail-hero">
                    <img src="{{ asset('images/cat-prewedding.jpg') }}" alt="Photo Prewedding">
                    <div class="cat-detail-hero-overlay">
                        <h1 class="cat-detail-hero-title">Photo Prewedding</h1>
                    </div>
                </div>

                <div class="cat-detail-content">
                    <div class="cat-slider-wrap">
                        <button class="cat-slider-btn cat-slider-prev" onclick="slideMove('prewedding', -1)">&#8592;</button>
                        <div class="cat-slider" id="slider-prewedding">
                            <div class="cat-slide"><img src="{{ asset('images/prewedding-1.jpg') }}" alt="Prewedding 1"></div>
                            <div class="cat-slide"><img src="{{ asset('images/prewedding-2.jpg') }}" alt="Prewedding 2"></div>
                            <div class="cat-slide"><img src="{{ asset('images/prewedding-3.jpg') }}" alt="Prewedding 3"></div>
                        </div>
                        <button class="cat-slider-btn cat-slider-next" onclick="slideMove('prewedding', 1)">&#8594;</button>
                        <div class="cat-slider-dots" id="dots-prewedding">
                            <span class="cat-dot active" onclick="slideTo('prewedding', 0)"></span>
                            <span class="cat-dot" onclick="slideTo('prewedding', 1)"></span>
                            <span class="cat-dot" onclick="slideTo('prewedding', 2)"></span>
                        </div>
                    </div>

                    <div class="cat-detail-info">
                        <div class="cat-detail-left">
                            <div class="cat-pricelist">
                                <h3 class="cat-info-heading">Pricelist</h3>
                                <p>4 hrs &nbsp;: Rp 1.800.000</p>
                                <p>6 hrs &nbsp;: Rp 2.500.000</p>
                                <p>8 hrs &nbsp;: Rp 3.200.000</p>
                            </div>
                            <div class="cat-hours">
                                <h3 class="cat-info-heading">Hours in studio</h3>
                                <p>Rp 450.000/hour</p>
                            </div>
                            <div class="cat-cta">
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn-wa">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                                <a href="#booking" class="btn-booking">Booking</a>
                            </div>
                        </div>

                        <div class="cat-detail-right">
                            <div class="cat-equip-grid">
                                <div>
                                    <h3 class="cat-info-heading">Romantic Studio</h3>
                                    <p class="cat-equip-desc">Setting romantis dengan dekorasi premium untuk sesi prewedding yang tak terlupakan.</p>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Equipment list</h3>
                                    <ul class="cat-equip-list">
                                        <li>Lighting Godox DP400III (2 pcs)</li>
                                        <li>Trigger Wireless Flash</li>
                                        <li>Softbox with Grid (2pcs)</li>
                                        <li>Translucent Umbrella 101cm</li>
                                        <li>Light Stand (2pcs)</li>
                                        <li>Boom Stand with Weight Bag</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Decoration package:</h3>
                                    <ul class="cat-equip-list">
                                        <li>Flower arch</li>
                                        <li>Neon sign</li>
                                        <li>Candle set</li>
                                    </ul>
                                    <p class="cat-equip-price">350k/package</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======= DETAIL: PHOTO PERSONAL ======= -->
            <div class="cat-detail" id="cat-personal">
                <div class="cat-detail-hero">
                    <img src="{{ asset('images/cat-personal.jpg') }}" alt="Photo Personal">
                    <div class="cat-detail-hero-overlay">
                        <h1 class="cat-detail-hero-title">Photo Personal</h1>
                    </div>
                </div>

                <div class="cat-detail-content">
                    <div class="cat-slider-wrap">
                        <button class="cat-slider-btn cat-slider-prev" onclick="slideMove('personal', -1)">&#8592;</button>
                        <div class="cat-slider" id="slider-personal">
                            <div class="cat-slide"><img src="{{ asset('images/personal-1.jpg') }}" alt="Personal 1"></div>
                            <div class="cat-slide"><img src="{{ asset('images/personal-2.jpg') }}" alt="Personal 2"></div>
                            <div class="cat-slide"><img src="{{ asset('images/personal-3.jpg') }}" alt="Personal 3"></div>
                        </div>
                        <button class="cat-slider-btn cat-slider-next" onclick="slideMove('personal', 1)">&#8594;</button>
                        <div class="cat-slider-dots" id="dots-personal">
                            <span class="cat-dot active" onclick="slideTo('personal', 0)"></span>
                            <span class="cat-dot" onclick="slideTo('personal', 1)"></span>
                            <span class="cat-dot" onclick="slideTo('personal', 2)"></span>
                        </div>
                    </div>

                    <div class="cat-detail-info">
                        <div class="cat-detail-left">
                            <div class="cat-pricelist">
                                <h3 class="cat-info-heading">Pricelist</h3>
                                <p>2 hrs &nbsp;: Rp 700.000</p>
                                <p>4 hrs &nbsp;: Rp 1.200.000</p>
                                <p>6 hrs &nbsp;: Rp 1.700.000</p>
                            </div>
                            <div class="cat-hours">
                                <h3 class="cat-info-heading">Hours in studio</h3>
                                <p>Rp 300.000/hour</p>
                            </div>
                            <div class="cat-cta">
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn-wa">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                                <a href="#booking" class="btn-booking">Booking</a>
                            </div>
                        </div>

                        <div class="cat-detail-right">
                            <div class="cat-equip-grid">
                                <div>
                                    <h3 class="cat-info-heading">Personal Studio</h3>
                                    <p class="cat-equip-desc">Studio compact ideal untuk sesi foto personal, headshot profesional, atau konten media sosial.</p>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Equipment list</h3>
                                    <ul class="cat-equip-list">
                                        <li>Lighting Godox DP400III (2 pcs)</li>
                                        <li>Trigger Wireless Flash</li>
                                        <li>Softbox with Grid (2pcs)</li>
                                        <li>Reflector Board</li>
                                        <li>Light Stand (2pcs)</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Additional for video:</h3>
                                    <ul class="cat-equip-list">
                                        <li>Godox SL 150W</li>
                                        <li>Ring Light</li>
                                        <li>Softbox with Grid</li>
                                    </ul>
                                    <p class="cat-equip-price">150k/lighting</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- /catDrawerBody --}}
    </div>{{-- /catDrawer --}}

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Virtual Imagination PhotoStudio. All rights reserved.</p>
    </footer>

 @verbatim
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
            background:
                radial-gradient(ellipse 70% 60% at 20% 30%, rgba(233,203,91,0.6) 0%, transparent 55%),
                radial-gradient(ellipse 60% 55% at 80% 20%, rgba(204,176,73,0.55) 0%, transparent 55%),
                radial-gradient(ellipse 50% 50% at 60% 85%, rgba(233,203,91,0.4) 0%, transparent 55%),
                linear-gradient(160deg, #ffffff 0%, #fff8dc 45%, #ffffff 100%);
            background-attachment: fixed;
        }

        /* ===== HERO ===== */
        .hero {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
        }

        .hero-bg { display: none; }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: transparent;
            z-index: 1;
        }

        .hero-content {
            top: 110px;
            position: relative;
            z-index: 2;
            padding: 140px 60px 0 60px;
        }

        .hero-title-vi {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 125px;
            line-height: 1.25;
            background: linear-gradient(90deg, #E9CB5B 100%, #FFFFFF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -2px;
        }

        .hero-title-ps {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 125px;
            line-height: 1;
            color: #111;
            letter-spacing: -2px;
            margin-bottom: 30px;
        }

        .hero-desc {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 400;
            font-size: 20px;
            color: #111;
            max-width: 1000px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .hero-desc b { font-weight: 700; }

        /* Social Bar */
        .social-bar {
            margin-top: 300px;
            padding: 70px 0 40px 0;
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .social-bar-inner {
            display: flex;
            align-items: center;
            background: rgba(50,50,50,0.82);
            border-radius: 40px;
            padding: 12px 32px;
            gap: 8px;
        }

        .social-bar-inner a {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.12em;
            text-decoration: none;
            padding: 6px 16px;
            border-radius: 30px;
            text-transform: uppercase;
            transition: background 0.2s;
        }

        .social-bar-inner a:hover { background: rgba(255,255,255,0.13); }

        .social-icon { width: 16px; height: 16px; fill: #fff; }

        /* ===== VISION & MISSION ===== */
        .vm-section {
            padding: 300px 0;
            background: transparent;
        }

        .vm-inner {
            max-width: 1500px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 60px;
            align-items: start;
            opacity: 0;
            transform: translateY(40px);
            animation: fadeUp 1s ease forwards;
        }

        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        .vm-left { padding-top: 10px; }

        .vm-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: 95px;
            line-height: 1.05;
            color: #111;
            letter-spacing: -2px;
            margin-bottom: 28px;
            position: relative;
        }

        .vm-heading::after {
            content: "";
            display: block;
            width: 80px;
            height: 4px;
            background: #111;
            margin-top: 16px;
        }

        .vm-divider {
            width: 100%;
            height: 1.5px;
            background: #ddd;
            margin-bottom: 28px;
        }

        .vm-body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 400;
            font-size: 16px;
            color: #444;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .vm-body b { font-weight: 700; color: #000; }

        .vm-divider-bottom {
            width: 100%;
            height: 1.5px;
            background: #ddd;
            margin-top: 32px;
        }

        .vm-photos {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            align-items: start;
        }

        .vm-photo-top-left { grid-column: 1; grid-row: 1; }
        .vm-photo-top-right { grid-column: 2; grid-row: 1; }

        .vm-photo-bottom-center {
            grid-column: 1 / span 2;
            display: flex;
            justify-content: center;
        }

        .vm-photo-bottom-center img { width: 55%; }

        .vm-photos img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            border-radius: 10px;
            display: block;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .vm-photos img:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        /* ===== CATEGORY SECTION ===== */
        .cat-section {
            padding: 80px 60px 100px;
            background: transparent;
            position: relative;
        }

        .cat-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .cat-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: 42px;
            color: #111;
            letter-spacing: -1px;
            margin-bottom: 14px;
        }

        .cat-title-line {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #C9A94A, #E9CB5B);
            margin: 0 auto;
            border-radius: 2px;
        }

        /* --- Grid --- */
        .cat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            max-width: 780px;
            margin: 0 auto;
        }

        .cat-card {
            position: relative;
            display: block;
            border-radius: 14px;
            overflow: hidden;
            cursor: pointer;
            text-decoration: none;
            /* PENTING: jangan pakai aspect-ratio saja — tambah min-height
               supaya card punya ukuran walau gambar belum load */
            aspect-ratio: 3 / 2;
            min-height: 180px;
            background: #d4c07a; /* fallback warna emas saat gambar belum load */
        }

        .cat-card--wide {
            grid-column: 1 / span 2;
            aspect-ratio: 16 / 6;
            min-height: 160px;
        }

        .cat-card img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s cubic-bezier(0.16,1,0.3,1), filter 0.4s ease;
            filter: brightness(0.82);
        }

        .cat-card:hover img {
            transform: scale(1.06);
            filter: brightness(0.65);
        }

        .cat-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.72) 0%, rgba(0,0,0,0.10) 55%, transparent 100%);
        }

        .cat-card-info {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 22px;
        }

        .cat-card-label {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            text-shadow: 0 2px 6px rgba(0,0,0,0.4);
            letter-spacing: -0.3px;
        }

        .cat-card-arrow {
            font-size: 18px;
            color: #fff;
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            width: 38px; height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.3s, transform 0.3s;
            backdrop-filter: blur(4px);
        }

        .cat-card:hover .cat-card-arrow {
            background: #C9A94A;
            border-color: #C9A94A;
            transform: translateX(4px);
        }

        /* Scroll reveal — pakai class .in-view via JS */
        .cat-card {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.55s ease, transform 0.55s ease;
        }

        .cat-card.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        .cat-card:nth-child(1) { transition-delay: 0.05s; }
        .cat-card:nth-child(2) { transition-delay: 0.13s; }
        .cat-card:nth-child(3) { transition-delay: 0.21s; }
        .cat-card:nth-child(4) { transition-delay: 0.29s; }
        .cat-card:nth-child(5) { transition-delay: 0.37s; }

        /* ===== DRAWER OVERLAY ===== */
        .cat-drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            backdrop-filter: blur(4px);
            z-index: 1200;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.35s ease, visibility 0.35s;
        }

        .cat-drawer-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        /* ===== DRAWER PANEL ===== */
        .cat-drawer {
            position: fixed;
            top: 0; right: 0;
            width: min(860px, 100vw);
            height: 100vh;
            background: #fff;
            z-index: 1300;
            display: flex;
            flex-direction: column;
            box-shadow: -24px 0 80px rgba(0,0,0,0.14);
            transform: translateX(100%);
            transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
            border-radius: 20px 0 0 20px;
            overflow: hidden;
        }

        .cat-drawer.open { transform: translateX(0); }

        .cat-drawer-topbar {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 28px;
            border-bottom: 1px solid rgba(201,169,74,0.15);
            background: #fff;
            flex-shrink: 0;
        }

        .cat-drawer-back {
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #444;
            background: none;
            border: none;
            cursor: pointer;
            padding: 7px 14px;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }

        .cat-drawer-back:hover { background: #f5f0e0; color: #C9A94A; }

        .cat-drawer-topbar-title {
            font-size: 15px;
            font-weight: 700;
            color: #111;
        }

        .cat-drawer-body {
            flex: 1;
            overflow-y: auto;
            scroll-behavior: smooth;
            overscroll-behavior: contain;
        }

        /* ===== DETAIL SECTIONS ===== */
        .cat-detail { display: none; }
        .cat-detail.active { display: block; }

        .cat-detail-hero {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: #111;
        }

        .cat-detail-hero img {
            width: 100%; height: 100%;
            object-fit: cover;
            opacity: 0.7;
            display: block;
        }

        .cat-detail-hero-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to bottom, transparent 20%, rgba(0,0,0,0.45) 100%);
        }

        .cat-detail-hero-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 42px;
            font-weight: 700;
            color: #fff;
            letter-spacing: -1px;
            text-shadow: 0 4px 20px rgba(0,0,0,0.4);
        }

        .cat-detail-content { padding: 36px 40px 60px; }

        /* ===== SLIDER ===== */
        .cat-slider-wrap {
            position: relative;
            margin-bottom: 40px;
            padding: 0 24px;
        }

        .cat-slider {
            display: flex;
            overflow: hidden;
            gap: 12px;
            border-radius: 12px;
        }

        .cat-slide {
            min-width: calc(33.33% - 8px);
            flex-shrink: 0;
            border-radius: 12px;
            overflow: hidden;
            aspect-ratio: 4/3;
            background: #e8e0cc;
            transition: transform 0.5s cubic-bezier(0.16,1,0.3,1);
        }

        .cat-slide img {
            width: 100%; height: 100%;
            object-fit: cover;
            display: block;
        }

        .cat-slider-btn {
            position: absolute;
            top: 50%; transform: translateY(-50%);
            width: 40px; height: 40px;
            background: rgba(255,255,255,0.92);
            border: 1px solid rgba(201,169,74,0.3);
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            z-index: 5;
            color: #333;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            transition: background 0.2s, color 0.2s;
        }

        .cat-slider-btn:hover { background: #C9A94A; color: #fff; border-color: #C9A94A; }
        .cat-slider-prev { left: 0; }
        .cat-slider-next { right: 0; }

        .cat-slider-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 16px;
        }

        .cat-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #ddd;
            cursor: pointer;
            transition: background 0.25s, transform 0.25s;
        }

        .cat-dot.active { background: #C9A94A; transform: scale(1.3); }

        /* ===== INFO ROW ===== */
        .cat-detail-info {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 40px;
            border-top: 1px solid #eee;
            padding-top: 32px;
        }

        .cat-detail-left {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .cat-info-heading {
            font-size: 14px;
            font-weight: 700;
            color: #111;
            margin-bottom: 6px;
        }

        .cat-pricelist p, .cat-hours p {
            font-size: 14px;
            color: #444;
            line-height: 1.9;
        }

        .cat-cta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 8px;
        }

        .btn-wa {
            display: flex; align-items: center; justify-content: center;
            width: 44px; height: 44px;
            background: #25D366;
            color: #fff;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(37,211,102,0.35);
            transition: transform 0.2s, box-shadow 0.2s;
            flex-shrink: 0;
        }

        .btn-wa:hover { transform: scale(1.08); box-shadow: 0 6px 20px rgba(37,211,102,0.45); }

        .btn-booking {
            display: inline-flex;
            align-items: center;
            padding: 11px 26px;
            background: #111;
            color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13.5px;
            font-weight: 700;
            border-radius: 50px;
            text-decoration: none;
            letter-spacing: 0.05em;
            transition: background 0.25s, transform 0.2s, box-shadow 0.25s;
            box-shadow: 0 4px 14px rgba(0,0,0,0.14);
        }

        .btn-booking:hover {
            background: #C9A94A;
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(201,169,74,0.35);
        }

        .cat-equip-grid {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .cat-equip-desc { font-size: 13.5px; color: #555; line-height: 1.7; }

        .cat-equip-list {
            list-style: none;
            padding: 0; margin: 0;
            display: flex; flex-direction: column; gap: 4px;
        }

        .cat-equip-list li {
            font-size: 13.5px;
            color: #444;
            line-height: 1.7;
            padding-left: 16px;
            position: relative;
        }

        .cat-equip-list li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #C9A94A;
        }

        .cat-equip-price {
            display: inline-block;
            margin-top: 10px;
            font-size: 13px;
            font-weight: 700;
            color: #C9A94A;
            background: rgba(201,169,74,0.1);
            padding: 4px 12px;
            border-radius: 50px;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: #111;
            color: #ccc;
            text-align: center;
            padding: 32px 40px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .footer a { color: #e9cb5b; text-decoration: none; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .hero-title-vi, .hero-title-ps { font-size: 60px; }
            .vm-heading { font-size: 56px; }
            .vm-inner { grid-template-columns: 1fr; }
            .hero-content { padding: 120px 20px 0 20px; }
            .vm-section { padding: 50px 20px 60px 20px; }
        }

        @media (max-width: 700px) {
            .cat-section { padding: 60px 20px 80px; }
            .cat-grid { grid-template-columns: 1fr; gap: 12px; }
            .cat-card--wide { grid-column: 1; aspect-ratio: 3/2; }
            .cat-drawer { width: 100vw; border-radius: 0; }
            .cat-detail-info { grid-template-columns: 1fr; }
            .cat-detail-hero-title { font-size: 28px; }
            .cat-slide { min-width: 80%; }
            .cat-detail-content { padding: 24px 20px 48px; }
        }
    </style>
    @endverbatim

    <script>
        /* =====================================================
           SCROLL: navbar shadow
           ===================================================== */
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (!navbar) return;
            navbar.style.boxShadow = window.scrollY > 10
                ? '0 2px 18px rgba(0,0,0,0.13)'
                : '0 1px 8px rgba(0,0,0,0.07)';
        });

        /* =====================================================
           CATEGORY DRAWER
           ===================================================== */
        const sliderState = {};

        function openCategory(id, e) {
            if (e) e.preventDefault();
            const drawer   = document.getElementById('catDrawer');
            const overlay  = document.getElementById('catDrawerOverlay');
            const body     = document.getElementById('catDrawerBody');
            const topTitle = document.getElementById('drawerTopTitle');

            document.querySelectorAll('.cat-detail').forEach(d => d.classList.remove('active'));
            const target = document.getElementById(id);
            if (!target) return;
            target.classList.add('active');

            topTitle.textContent = target.querySelector('.cat-detail-hero-title')?.textContent || '';
            drawer.classList.add('open');
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
            body.scrollTop = 0;
        }

        function closeCategory() {
            document.getElementById('catDrawer').classList.remove('open');
            document.getElementById('catDrawerOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeCategory(); });

        /* =====================================================
           SLIDER ENGINE
           ===================================================== */
        function getSlider(key) {
            if (!sliderState[key]) sliderState[key] = { idx: 0, total: 3 };
            return sliderState[key];
        }

        function slideTo(key, idx) {
            const state  = getSlider(key);
            const track  = document.getElementById('slider-' + key);
            if (!track) return;
            const slides = track.querySelectorAll('.cat-slide');
            state.total  = slides.length;
            state.idx    = Math.max(0, Math.min(idx, state.total - 1));

            slides.forEach((s, i) => {
                const offset = (i - state.idx) * (100 / 3 + 1.5);
                s.style.transform  = `translateX(${offset}%)`;
                s.style.opacity    = Math.abs(i - state.idx) <= 1 ? '1' : '0.4';
                s.style.transition = 'transform 0.5s cubic-bezier(0.16,1,0.3,1), opacity 0.4s ease';
            });

            document.querySelectorAll('#dots-' + key + ' .cat-dot')
                .forEach((d, i) => d.classList.toggle('active', i === state.idx));
        }

        function slideMove(key, dir) {
            slideTo(key, getSlider(key).idx + dir);
        }

        /* =====================================================
           DOM READY
           ===================================================== */
        document.addEventListener('DOMContentLoaded', function () {

            /* Init sliders */
            ['events','graduation','group','prewedding','personal'].forEach(key => {
                sliderState[key] = { idx: 0, total: 3 };
            });

            /* ---- SCROLL REVEAL untuk category cards ----
               Pakai threshold: 0 supaya langsung trigger
               begitu 1px card masuk viewport,
               tanpa tergantung apakah gambar sudah load atau belum */
            const cards = document.querySelectorAll('.cat-card');

            if ('IntersectionObserver' in window) {
                const io = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('in-view');
                            io.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0, rootMargin: '0px 0px -40px 0px' });

                cards.forEach(c => io.observe(c));
            } else {
                /* Fallback untuk browser lama */
                cards.forEach(c => c.classList.add('in-view'));
            }

            /* ---- Deep link via hash ---- */
            const hash = window.location.hash.replace('#', '');
            const validCats = ['cat-events','cat-graduation','cat-group','cat-prewedding','cat-personal'];
            if (validCats.includes(hash)) openCategory(hash, null);
        });
    </script>
</body>
</html>
