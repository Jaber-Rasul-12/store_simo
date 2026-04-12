 // تأثيرات دخول عند التمرير
        document.addEventListener('DOMContentLoaded', function() {
            // إظهار العناصر عند التمرير
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);
            
            // مراقبة جميع عناصر المنتجات
            document.querySelectorAll('.animate-on-scroll').forEach(element => {
                observer.observe(element);
            });
            
            // فلتر المنتجات
            const filterBtns = document.querySelectorAll('.filter-btn');
            const productItems = document.querySelectorAll('.product-item');
            
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // إزالة النشاط من جميع الأزرار
                    filterBtns.forEach(b => b.classList.remove('active'));
                    
                    // إضافة النشاط للزر المحدد
                    this.classList.add('active');
                    
                    const filterValue = this.getAttribute('data-filter');
                    
                    // إخفاء وإظهار المنتجات بناءً على الفلتر
                    productItems.forEach(item => {
                        if (filterValue === 'all') {
                            item.parentElement.style.display = 'block';
                        } else {
                            if (item.querySelector(`.${filterValue}`)) {
                                item.parentElement.style.display = 'block';
                            } else {
                                item.parentElement.style.display = 'none';
                            }
                        }
                        
                        // إضافة تأثير عند التغيير
                        item.style.animation = 'none';
                        setTimeout(() => {
                            item.style.animation = 'cardEntrance 0.6s ease-out';
                        }, 10);
                    });
                });
            });
            
            // تأثيرات Hover المتقدمة
            productItems.forEach(item => {
                // تأثير الضوء التفاعلي
                item.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    this.style.setProperty('--mouse-x', `${x}px`);
                    this.style.setProperty('--mouse-y', `${y}px`);
                });
                
                // تأثير النقر
                item.addEventListener('click', function() {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 200);
                });
            });
            
            // تأثير إضافة إلى السلة
            const addToCartBtns = document.querySelectorAll('.btn:last-child');
            addToCartBtns.forEach(btn => {
                // btn.addEventListener('click', function(e) {
                //     e.preventDefault();
                    
                //     // تأثير النقر
                //     this.style.transform = 'scale(0.95)';
                    
                //     // تغيير النص والأيقونة مؤقتاً
                //     const originalHTML = this.innerHTML;
                //     this.innerHTML = '<i class="fas fa-check mr-1"></i>تمت الإضافة';
                //     this.style.background = 'linear-gradient(135deg, var(--success-color), #2f855a)';
                    
                //     // استعادة الحالة الأصلية بعد 2 ثانية
                //     setTimeout(() => {
                //         this.innerHTML = originalHTML;
                //         this.style.background = '';
                //         this.style.transform = '';
                //     }, 2000);
                    
                //     // تأثير اهتزاز للسلة (يمكن ربطه بعدد العناصر)
                //     const cartIcon = document.querySelector('.fa-shopping-cart');
                //     if (cartIcon) {
                //         cartIcon.parentElement.style.animation = 'shake 0.5s';
                //         setTimeout(() => {
                //             cartIcon.parentElement.style.animation = '';
                //         }, 500);
                //     }
                // });
            });
            
            // تأثير الهز للعناصر
            const style = document.createElement('style');
            style.textContent = `
                @keyframes shake {
                    0%, 100% { transform: translateX(0); }
                    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                    20%, 40%, 60%, 80% { transform: translateX(5px); }
                }
                
                /* تأثير الضوء التفاعلي */
                .product-item {
                    --mouse-x: 0;
                    --mouse-y: 0;
                }
                
                .product-item::after {
                    top: var(--mouse-y);
                    right: var(--mouse-x);
                }
            `;
            document.head.appendChild(style);
            
            // تحميل صور المنتجات بتأثير
            const productImages = document.querySelectorAll('.product-image');
            productImages.forEach(img => {
                img.addEventListener('load', function() {
                    this.style.opacity = '0';
                    this.style.transform = 'scale(0.9)';
                    
                    setTimeout(() => {
                        this.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                        this.style.opacity = '1';
                        this.style.transform = 'scale(1)';
                    }, 100);
                });
                
                // إضافة تأثير التحميل إذا كانت الصورة محملة مسبقاً
                if (img.complete) {
                    img.dispatchEvent(new Event('load'));
                }
            });
            
            // تأثيرات للشاشات الصغيرة
            if (window.innerWidth <= 768) {
                productItems.forEach(item => {
                    item.style.cursor = 'pointer';
                    
                    item.addEventListener('touchstart', function() {
                        this.style.transform = 'scale(0.98)';
                    });
                    
                    item.addEventListener('touchend', function() {
                        setTimeout(() => {
                            this.style.transform = '';
                        }, 200);
                    });
                });
            }
        });
        
        // تأثيرات الـ Scroll الناعم
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            
            document.querySelectorAll('.product-item').forEach((item, index) => {
                if (this.checkVisibility(item)) {
                    item.style.transform = `translateY(${rate * 0.1}px)`;
                }
            });
        });
        
        // دالة للتحقق من ظهور العنصر
        Element.prototype.checkVisibility = function() {
            const rect = this.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        };