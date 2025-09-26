/*
The MIT License (MIT)
Copyright (c) 2015 Pascal Dittrich

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and 
associated documentation files (the "Software"), to deal in the Software without restriction, including 
without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell 
copies of the Software, and to permit persons to whom the Software is furnished to do so, subject 
to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO 
THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE 
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, 
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

(function ($) {
	"use strict";

	$.fn.halloweenBats = function (options) {

		var defaults = {
			image: '/modules/halloweenbats/views/img/bats.png', // Path to the image.
			zIndex: 100000, // The z-index you need.
			amount: 5, // Bat amount.
			width: 35, // Image width.
			height: 20, // Animation frame height.
			frames: 4, // Amount of animation frames.
			speed: 20, // Higher value = faster.
			flickering: 15, // Higher value = slower.
			target: 'html' // Target element
		};

		options = $.extend({}, defaults, options);

		var Bat,
			bats = [],
			$body= $(options.target),
			innerWidth = $body.innerWidth(),
			innerHeight = $body.innerHeight(),
			counter;

		Bat = function () {
			var self = this,
				$bat = $('<div class="halloweenBat"/>'),
				x,
				y,
				tx,
				ty,
				dx,
				dy,
				frame;

			/**
			 * @param {string} direction
			 * @returns {number}
			 */
			self.randomPosition = function (direction) {
				var screenLength,
					imageLength;

				if (direction === 'horizontal') {
					screenLength = innerWidth;
					imageLength = options.width;
				}
				else {
					screenLength = innerHeight;
					imageLength = options.height;
				}

				return Math.random() * (screenLength - imageLength);
			};

			self.applyPosition = function () {
				$bat.css({
					left: x + 'px',
					top: y + 'px'
				});
			};

			self.move = function () {
				var left,
					top,
					length,
					dLeft,
					dTop,
					ddLeft,
					ddTop;

				left = tx - x;
				top = ty - y;

				length = Math.sqrt(left * left + top * top);
				length = Math.max(1, length);

				dLeft = options.speed * (left / length);
				dTop = options.speed * (top / length);

				ddLeft = (dLeft - dx) / options.flickering;
				ddTop = (dTop - dy) / options.flickering;

				dx += ddLeft;
				dy += ddTop;

				x += dx;
				y += dy;

				x = Math.max(0, Math.min(x, innerWidth - options.width));
				y = Math.max(0, Math.min(y, innerHeight - options.height));

				self.applyPosition();

				if (Math.random() > 0.95 ) {
					tx = self.randomPosition('horizontal');
					ty = self.randomPosition('vertical');
				}
			};

			self.animate = function () {
				frame += 1;

				if (frame >= options.frames) {
					frame -= options.frames;
				}

				$bat.css(
					'backgroundPosition',
					'0 ' + (frame * -options.height) + 'px'
				);
			};


			x = self.randomPosition('horizontal');
			y = self.randomPosition('vertical');
			tx = self.randomPosition('horizontal');
			ty = self.randomPosition('vertical');
			dx = -5 + Math.random() * 10;
			dy = -5 + Math.random() * 10;

			frame = Math.random() * options.frames;
			frame = Math.round(frame);

			$body.append($bat);
			$bat.css({
				position: 'absolute',
				left: x + 'px',
				top: y + 'px',
				zIndex: options.zIndex,
				width: options.width + 'px',
				height: options.height + 'px',
				backgroundImage: 'url(' + options.image + ')',
				backgroundRepeat: 'no-repeat'
			});

			window.setInterval(self.move, 40);
			window.setInterval(self.animate, 200);
		};

		for (counter = 0; counter < options.amount; ++counter) {
			bats.push(new Bat());
		}

		$(window).resize(function() {
			innerWidth = $body.innerWidth();
			innerHeight = $body.innerHeight();
		});
	};
}(jQuery));