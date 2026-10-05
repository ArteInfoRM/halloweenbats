/**
 * @author    Arte e Informatica <helpdesk@tecnoacquisti.com>
 * @copyright 2026 Tecnoacquisti.com
 * @license   https://opensource.org/licenses/MIT MIT License; see LICENSE
 */
(() => {
  const configure = () => {
    const engine = document.querySelector('[name="HALLOWEEN_ENGINE"]');
    if (!engine) return;
    const update = () => {
      const control = document.querySelector('[name="HALLOWEEN_JQUERY"]');
      if (control && control.closest('.form-group')) {
        control.closest('.form-group').hidden = engine.value !== 'jquery';
      }
    };
    engine.addEventListener('change', update);
    update();
    ['HALLOWEEN_AMOUNT', 'HALLOWEEN_SPEED'].forEach((name) => {
      const input = document.querySelector(`[name="${name}"]`);
      if (input) {
        input.type = 'number';
        input.min = '1';
        input.max = '100';
        input.step = '1';
        input.required = true;
      }
    });
  };
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', configure);
  else configure();
})();
