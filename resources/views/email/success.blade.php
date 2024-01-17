@extends('base')
@section('content')

<div class="success-message-container">
    <div id="confetti-wrapper"></div>
    <h1 class="success-message">Your email was sent successfully 🎊 !</h1>
</div>


<script src="/js/redirect-countdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script>
<script>
    const jsConfetti = new JSConfetti()

    jsConfetti.addConfetti({
        confettiRadius: 6,
        confettiNumber: 1000
    })
    
    // Redirection après 5 secondes
    setTimeout(function() {
        window.location.href = '/'; // Changez '/' par l'URL de destination souhaitée
    }, 5000);
</script>


@endsection