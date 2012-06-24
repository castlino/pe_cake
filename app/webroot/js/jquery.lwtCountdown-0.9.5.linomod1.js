/*!
 * jQuery Countdown plugin v0.9.5
 * http://www.littlewebthings.com/projects/countdown/
 *
 * Copyright 2010, Vassilis Dourdounis
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/*!
 *Modified to include microseconds.... -LiNo
 **/
(function($){

	$.fn.countDown = function (options) {

		config = {};

		$.extend(config, options);

		diffSecs = this.setCountDown(config);

		$('#' + $(this).attr('id') + ' .digit').html('<div class="top"></div><div class="bottom"></div>');
		//$(this).doCountDown($(this).attr('id'), diffSecs, 500);
                $(this).milliCountdown($(this).attr('id'), diffSecs, 0);

		if (config.onComplete)
		{
			$.data($(this)[0], 'callback', config.onComplete);
		}
		if (config.omitWeeks)
		{
			$.data($(this)[0], 'omitWeeks', config.omitWeeks);
		}
		return this;

	};

	$.fn.stopCountDown = function () {
		clearTimeout($.data(this[0], 'timer'));
	};

	$.fn.startCountDown = function () {
		//this.doCountDown($(this).attr('id'),$.data(this[0], 'diffSecs'), 500);
                this.milliCountdown($(this).attr('id'), diffSecs, 99);
	};

	$.fn.setCountDown = function (options) {
		var targetTime = new Date();

		if (options.targetDate)
		{
			targetTime.setDate(options.targetDate.day);
			targetTime.setMonth(options.targetDate.month-1);
			targetTime.setFullYear(options.targetDate.year);
			targetTime.setHours(options.targetDate.hour);
			targetTime.setMinutes(options.targetDate.min);
			targetTime.setSeconds(options.targetDate.sec);
		}
		else if (options.targetOffset)
		{
			targetTime.setDate(options.targetOffset.day + targetTime.getDate());
			targetTime.setMonth(options.targetOffset.month + targetTime.getMonth());
			targetTime.setFullYear(options.targetOffset.year + targetTime.getFullYear());
			targetTime.setHours(options.targetOffset.hour + targetTime.getHours());
			targetTime.setMinutes(options.targetOffset.min + targetTime.getMinutes());
			targetTime.setSeconds(options.targetOffset.sec + targetTime.getSeconds());
		}

		var nowTime = new Date();

		diffSecs = Math.floor((targetTime.valueOf()-nowTime.valueOf())/1000);

		$.data(this[0], 'diffSecs', diffSecs);

		return diffSecs;
	};



	$.fn.milliCountdown = function(id, diffSecs, milliSecs){
                $this = $('#' + id);
                $('.milliseconds_dash .digit').html(milliSecs);
                 if (milliSecs >= 1)
                 {
                        milliSecs = milliSecs - 1;
                 }else{
                        //$.data($this[0], 'diffSecs', diffSecs);
                        //$.data($this[0], 'milliSecs', milliSecs);
                        diffSecs = $this.doCountDown($(this).attr('id'),diffSecs-1, 500);
                        if(diffSecs>0){
                            milliSecs = 99;
                        }else{
                            return;
                        }
                 }
                 

                 e = this;
                 setTimeout(function() { e.milliCountdown(id, diffSecs, milliSecs) } , 10);
        }

	$.fn.doCountDown = function (id, diffSecs, duration) {
		$this = $('#' + id);
		if (diffSecs <= 0)
		{
			diffSecs = 0;
			if ($.data($this[0], 'timer'))
			{
				clearTimeout($.data($this[0], 'timer'));
			}
		}

		secs = diffSecs % 60;
		mins = Math.floor(diffSecs/60)%60;
		//hours = Math.floor(diffSecs/60/60)%24;
                hours = Math.floor(diffSecs/60/60);                // Round off till days only, not weeks.
		if ($.data($this[0], 'omitWeeks') == true)
		{
			//days = Math.floor(diffSecs/60/60/24);
			//weeks = Math.floor(diffSecs/60/60/24/7);
                        days = Math.floor(diffSecs/60/60/168);          // Round of till days only, not weeks.
			weeks = Math.floor(diffSecs/60/60/24/7);        // Round of till days only, not weeks.
		}
		else 
		{
			days = Math.floor(diffSecs/60/60/24)%7;
			weeks = Math.floor(diffSecs/60/60/24/7);
		}

		$this.dashChangeTo(id, 'seconds_dash', secs, duration ? duration : 800);
		$this.dashChangeTo(id, 'minutes_dash', mins, duration ? duration : 1200);
		$this.dashChangeTo(id, 'hours_dash', hours, duration ? duration : 1200);
		$this.dashChangeTo(id, 'days_dash', days, duration ? duration : 1200);
		$this.dashChangeTo(id, 'weeks_dash', weeks, duration ? duration : 1200);

		//$.data($this[0], 'diffSecs', diffSecs);
		if (diffSecs > 0)
		{
			//e = $this;
			//t = setTimeout(function() { e.doCountDown(id, diffSecs-1) } , 1000);
			//$.data(e[0], 'timer', t);
 
		} 
		//else if (cb == $.data($this[0], 'callback'))
                else 
		{
			$.data($this[0], 'callback')();
		}
                                           return diffSecs;
	};

	$.fn.dashChangeTo = function(id, dash, n, duration) {
		$this = $('#' + id);

                if(n<100)
                    {
                        d2 = n%10;
                        d1 = (n - n%10) / 10

                        if ($('#' + $this.attr('id') + ' .' + dash))
                        {
                            if(dash=="hours_dash")
                            {   // reverse the order as hours dash div has a right css alignment.
                                $this.digitChangeTo('#' + $this.attr('id') + ' .' + dash + ' .digit:first', d2, duration);
                                $this.digitChangeTo('#' + $this.attr('id') + ' .' + dash + ' .digit:last', d1, duration);
                            }else{
                                $this.digitChangeTo('#' + $this.attr('id') + ' .' + dash + ' .digit:first', d1, duration);
                                $this.digitChangeTo('#' + $this.attr('id') + ' .' + dash + ' .digit:last', d2, duration);
                            }
                        }
                        return;
                    }
                if(n>99 && dash=="days_dash")
                    {
                       d3 = n%10
                       d2 = ((n%100)-d3) / 10
                       d1 = (n - n%100) / 100

                       if ($('#' + $this.attr('id') + ' .' + dash))
                       {
                               $this.digitChangeTo('#' + $this.attr('id') + ' .' + dash + ' .digit:nth-child(2)', d1, duration);
                               $this.digitChangeTo('#' + $this.attr('id') + ' .' + dash + ' .digit:nth-child(3)', d2, duration);
                               $this.digitChangeTo('#' + $this.attr('id') + ' .' + dash + ' .digit:nth-child(4)', d3, duration);
                       }
                       return;
                    }
                if(n>99 && dash=="hours_dash")
                    {
                       d3 = n%10
                       d2 = ((n%100)-d3) / 10
                       d1 = (n - n%100) / 100

                       if ($('#' + $this.attr('id') + ' .' + dash))
                       {        // reverse the order as hours dash div has a right css alignment.
                               $this.digitChangeTo('#' + $this.attr('id') + ' .' + dash + ' .digit:nth-child(2)', d3, duration);
                               $this.digitChangeTo('#' + $this.attr('id') + ' .' + dash + ' .digit:nth-child(3)', d2, duration);
                               $this.digitChangeTo('#' + $this.attr('id') + ' .' + dash + ' .digit:nth-child(4)', d1, duration);
                       }
                       return;
                    }
	};

	$.fn.digitChangeTo = function (digit, n, duration) {
		if (!duration)
		{
			duration = 500;
		}
		if ($(digit + ' div.top').html() != n + '')
		{

			$(digit + ' div.top').css({'display': 'none'});
			$(digit + ' div.top').html((n ? n : '0')).slideDown(duration);
			//$(digit + ' div.top').html((n ? n : '0')).fadeOut(duration);
                        //$(digit + ' div.top').html((n ? n : '0')).fadeIn(duration);



			$(digit + ' div.bottom').animate({'height': ''}, duration, function() {
				$(digit + ' div.bottom').html($(digit + ' div.top').html());
				$(digit + ' div.bottom').css({'display': 'block', 'height': ''});
				$(digit + ' div.top').hide().slideUp(10);

			
			});

		}
	};

})(jQuery);

