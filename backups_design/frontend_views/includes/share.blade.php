@php
	$shareUrl = $shareUrl ?? url()->current();
	$shareTitle = $shareTitle ?? (config('app.name'));
@endphp

<style>
	.share-icons { display:inline-flex; align-items:center; gap:8px; }
	.share-icons a { width:28px; height:28px; border-radius:9999px; display:inline-flex; align-items:center; justify-content:center; color:#fff !important; text-decoration:none; transition:transform .15s ease, opacity .15s ease; }
	.share-icons a:hover { transform:translateY(-1px); opacity:.9; }
	.share-icons i { font-size:16px; line-height:1; }
	.share-icons .share-fb { background:#1877F2; }
	.share-icons .share-x { background:#0F1419; }
	.share-icons .share-li { background:#0A66C2; }
	.share-icons .share-wa { background:#25D366; }
	.share-icons .share-tg { background:#0088cc; }
	.share-icons .share-rd { background:#FF4500; }
	.share-icons .share-ig { background: radial-gradient( circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90% ); }
	.share-icons a[data-copied] { box-shadow: 0 0 0 2px #28a745 inset; }
</style>

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

