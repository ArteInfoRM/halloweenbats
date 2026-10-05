/**
 * @author    Arte e Informatica <helpdesk@tecnoacquisti.com>
 * @copyright 2026 Tecnoacquisti.com
 * @license   https://opensource.org/licenses/MIT MIT License; see LICENSE
 */
(() => {
  const start = () => {
    const config = document.getElementById('halloween-bats-config');
    if (!config || config.getAttribute('data-started') === '1') return;
    const number = (name, fallback) => {
      const raw = config.getAttribute(name);
      return /^[0-9]{1,3}$/.test(raw) && Number(raw) >= 1 && Number(raw) <= 100
        ? Number(raw) : fallback;
    };
    const image = new URL(config.getAttribute('data-image'), window.location.href);
    if (image.origin !== window.location.origin) return;
    const options = {
      image: image.href,
      amount: number('data-amount', 5),
      speed: number('data-speed', 20),
    };
    if (config.getAttribute('data-engine') === 'vanilla' && window.halloweenBatsVanilla) {
      config.setAttribute('data-started', '1');
      window.halloweenBatsVanilla(options);
    } else if (config.getAttribute('data-engine') === 'jquery'
      && window.jQuery && window.jQuery.fn.halloweenBats) {
      config.setAttribute('data-started', '1');
      window.jQuery.fn.halloweenBats(options);
    }
  };
  if (document.readyState === 'complete') start();
  else document.addEventListener('DOMContentLoaded', start);
})();
