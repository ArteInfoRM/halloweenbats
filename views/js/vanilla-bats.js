/**
 * Vanilla animation using the separately licensed Pascal Dittrich bat sprite.
 *
 * @author    Arte e Informatica <helpdesk@tecnoacquisti.com>
 * @copyright 2026 Tecnoacquisti.com
 * @license   https://opensource.org/licenses/MIT MIT License; see LICENSE
 */
(() => {
  window.halloweenBatsVanilla = (options) => {
    const bats = [];
    let previousTime = 0;
    let animationTime = 0;
    const bounds = () => ({
      width: Math.max(0, document.documentElement.clientWidth - 35),
      height: Math.max(0, window.innerHeight - 20),
    });
    let size = bounds();

    for (let index = 0; index < options.amount; index += 1) {
      const element = document.createElement('div');
      element.className = 'halloweenBat';
      element.setAttribute('aria-hidden', 'true');
      Object.assign(element.style, {
        position: 'fixed',
        top: '0',
        left: '0',
        width: '35px',
        height: '20px',
        zIndex: '100000',
        pointerEvents: 'none',
        backgroundImage: `url("${options.image}")`,
        backgroundRepeat: 'no-repeat',
      });
      document.body.appendChild(element);
      bats.push({
        element,
        x: Math.random() * size.width,
        y: Math.random() * size.height,
        targetX: Math.random() * size.width,
        targetY: Math.random() * size.height,
        frame: Math.floor(Math.random() * 4),
      });
    }

    const animate = (time) => {
      const elapsed = previousTime ? Math.min(time - previousTime, 80) : 0;
      previousTime = time;
      animationTime += elapsed;
      const nextFrame = animationTime >= 200;
      if (nextFrame) animationTime %= 200;
      bats.forEach((bat) => {
        const dx = bat.targetX - bat.x;
        const dy = bat.targetY - bat.y;
        const distance = Math.sqrt(dx * dx + dy * dy);
        const step = Math.min(distance, options.speed * elapsed / 40);
        if (distance > 0) {
          bat.x += dx / distance * step;
          bat.y += dy / distance * step;
        }
        bat.x = Math.max(0, Math.min(size.width, bat.x));
        bat.y = Math.max(0, Math.min(size.height, bat.y));
        if (distance <= step) {
          bat.targetX = Math.random() * size.width;
          bat.targetY = Math.random() * size.height;
        }
        if (nextFrame) bat.frame = (bat.frame + 1) % 4;
        bat.element.style.transform = `translate(${bat.x}px, ${bat.y}px)`;
        bat.element.style.backgroundPosition = `0 ${-20 * bat.frame}px`;
      });
      window.requestAnimationFrame(animate);
    };
    window.addEventListener('resize', () => {
      size = bounds();
      bats.forEach((bat) => {
        bat.targetX = Math.random() * size.width;
        bat.targetY = Math.random() * size.height;
      });
    });
    window.requestAnimationFrame(animate);
  };
})();
