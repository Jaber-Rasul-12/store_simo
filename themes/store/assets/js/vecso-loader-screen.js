 // التأكد من وجود الصفحة وإخفاء شاشة التحميل
    (function() {
        // نصوص تحميل ديناميكية
        const loadingTexts = [
            'جاري التحميل',
            'تحضير المتعة',
            'تجهيز المنتجات',
            'مرحباً بك في Vecso'
        ];
        
        let textIndex = 0;
        let textInterval;
        
     
        function hideLoader() {
            const loadingScreen = document.getElementById('vecsoLoaderScreen');
            if (loadingScreen) {
                loadingScreen.classList.add('fade-out');
                if (textInterval) clearInterval(textInterval);
                
                setTimeout(function() {
                    loadingScreen.style.display = 'none';
                }, 800);
            }
        }
        
       
        function startTextAnimation() {
            const statusSpan = document.querySelector('.vecso-loading-status span:first-child');
            if (!statusSpan) return;
            
            textInterval = setInterval(() => {
                if (statusSpan && textIndex < loadingTexts.length - 1) {
                    textIndex++;
                    statusSpan.style.opacity = '0';
                    setTimeout(() => {
                        if (statusSpan) {
                            statusSpan.textContent = loadingTexts[textIndex];
                            statusSpan.style.opacity = '1';
                        }
                    }, 200);
                } else if (textIndex >= loadingTexts.length - 1) {
                    clearInterval(textInterval);
                }
            }, 800);
        }
        
        // انتظار تحميل الصفحة بالكامل
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                startTextAnimation();
            });
        } else {
            startTextAnimation();
        }
        
        // إخفاء شاشة التحميل بعد تحميل كل شيء
        window.addEventListener('load', function() {
            // تأخير بسيط لضمان ظهور المحتوى
            setTimeout(hideLoader, 2500);
        });
        
        // تأمين إضافي: إخفاء بعد 3 ثواني كحد أقصى
        setTimeout(hideLoader, 3500);
        
        // إعادة الظهور عند النقر على الروابط (اختياري)
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && link.href && !link.target && !link.href.startsWith('javascript:')) {
                const currentDomain = window.location.origin;
                if (link.href.startsWith(currentDomain) || link.href.startsWith('/')) {
                    const loaderScreen = document.getElementById('vecsoLoaderScreen');
                    if (loaderScreen && loaderScreen.style.display === 'none') {
                        loaderScreen.style.display = 'flex';
                        loaderScreen.classList.remove('fade-out');
                        // إخفاء مرة أخرى بعد التحميل
                        setTimeout(function() {
                            window.addEventListener('load', function() {
                                setTimeout(hideLoader, 1500);
                            });
                        }, 100);
                    }
                }
            }
        });
    })();