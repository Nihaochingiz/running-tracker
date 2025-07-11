document.addEventListener('DOMContentLoaded', function() {
    // Анимация прогресс-бара
    const progressBars = document.querySelectorAll('.progress');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0';
        setTimeout(() => {
            bar.style.width = width;
        }, 100);
    });
    
    // Валидация формы
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const distance = form.querySelector('input[name="distance"]');
            const time = form.querySelector('input[name="time"]');
            
            if (parseFloat(distance.value) <= 0) {
                alert('Дистанция должна быть больше 0 км');
                e.preventDefault();
                return;
            }
            
            if (parseInt(time.value) <= 0) {
                alert('Время должно быть больше 0 минут');
                e.preventDefault();
                return;
            }
        });
    });
    
    // Уведомление о новом уровне
    if (window.location.href.includes('level_up')) {
        setTimeout(() => {
            alert('Поздравляем с новым уровнем!');
        }, 500);
    }
});
