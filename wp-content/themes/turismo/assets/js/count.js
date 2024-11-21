function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = timestamp => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

document.addEventListener('DOMContentLoaded', function () {
    const island = document.getElementById('island-value');
    const beachs = document.getElementById('beachs-value');
    const waterfall = document.getElementById('waterfall-value');
    const alembic = document.getElementById('alembic-value');
    animateValue(island, 0, 65, 4000);
    animateValue(beachs, 0, 60, 4000);
    animateValue(waterfall, 0, 19, 4000);
    animateValue(alembic, 0, 100, 4000);
});