@php
	$shareUrl = $shareUrl ?? url()->current();
	$shareTitle = $shareTitle ?? (config('app.name'));
@endphp


<div class="share-icons my-2">
	<a class="share-fb" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" rel="noopener" aria-label="Share on Facebook">
		<i class="fab fa-facebook-f"></i>
	</a>
	<a class="share-x" href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareTitle) }}" target="_blank" rel="noopener" aria-label="Share on X">
		<i class="fab fa-x-twitter"></i>
	</a>
	<a class="share-li" href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}" target="_blank" rel="noopener" aria-label="Share on LinkedIn">
		<i class="fab fa-linkedin-in"></i>
	</a>
	<a class="share-wa" href="https://api.whatsapp.com/send?text={{ urlencode($shareTitle.' '.$shareUrl) }}" target="_blank" rel="noopener" aria-label="Share on WhatsApp">
		<i class="fab fa-whatsapp"></i>
	</a>
	<a class="share-tg" href="https://t.me/share/url?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareTitle) }}" target="_blank" rel="noopener" aria-label="Share on Telegram">
		<i class="fab fa-telegram-plane"></i>
	</a>
	<!--<a class="share-rd" href="https://www.reddit.com/submit?url={{ urlencode($shareUrl) }}&title={{ urlencode($shareTitle) }}" target="_blank" rel="noopener" aria-label="Share on Reddit">-->
	<!--	<i class="fab fa-reddit-alien"></i>-->
	<!--</a>-->
	<a class="share-ig" href="#" onclick="shareOrCopy('{{ addslashes($shareUrl) }}','{{ addslashes($shareTitle) }}', this); return false;" aria-label="Share for Instagram (copies link if share not available)">
		<i class="fab fa-instagram"></i>
	</a>
</div>

<script>
	window.copyShareLink = window.copyShareLink || function(url, el) {
		if (navigator.clipboard && navigator.clipboard.writeText) {
			navigator.clipboard.writeText(url).then(function() {
				el.setAttribute('data-copied','');
				setTimeout(function(){ el.removeAttribute('data-copied'); }, 1200);
			});
		} else {
			// Fallback
			var ta = document.createElement('textarea');
			ta.value = url;
			document.body.appendChild(ta);
			ta.select();
			try { document.execCommand('copy'); } catch(e) {}
			document.body.removeChild(ta);
			el.setAttribute('data-copied','');
			setTimeout(function(){ el.removeAttribute('data-copied'); }, 1200);
		}
	};
	window.shareOrCopy = window.shareOrCopy || function(url, title, el) {
		if (navigator.share) {
			navigator.share({ title: title || document.title, text: title || document.title, url: url })
				.catch(function(){ copyShareLink(url, el); });
		} else {
			copyShareLink(url, el);
		}
	};
</script>

