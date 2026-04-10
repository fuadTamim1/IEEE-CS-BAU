<div id="cookieConsentBanner" class="cookie-consent" role="dialog" aria-live="polite" aria-label="Cookie Consent">
    <div class="cookie-consent__content">
        <p>
            We use cookies to improve your browsing experience, analyze site traffic, and support chapter services.
            By continuing to use this site, you agree to our use of cookies.
        </p>
        <button type="button" id="cookieConsentAccept" class="cookie-consent__button">Accept</button>
    </div>
</div>

<style>
    .cookie-consent {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 12000;
        padding: 16px;
        transform: translateY(110%);
        opacity: 0;
        pointer-events: none;
        transition: transform 0.4s ease, opacity 0.35s ease;
    }

    .cookie-consent.is-visible {
        transform: translateY(0);
        opacity: 1;
        pointer-events: auto;
    }

    .cookie-consent.is-hiding {
        transform: translateY(110%);
        opacity: 0;
        pointer-events: none;
    }

    .cookie-consent__content {
        max-width: 980px;
        margin: 0 auto;
        background: #062d4b;
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 12px;
        box-shadow: 0 12px 34px rgba(0, 0, 0, 0.22);
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .cookie-consent__content p {
        margin: 0;
        font-size: 14px;
        line-height: 1.6;
    }

    .cookie-consent__button {
        border: 0;
        border-radius: 8px;
        background: #00a3e0;
        color: #ffffff;
        padding: 10px 18px;
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
        transition: transform 0.2s ease, background-color 0.2s ease;
    }

    .cookie-consent__button:hover,
    .cookie-consent__button:focus-visible {
        background: #008dc2;
        transform: translateY(-1px);
    }

    @media (max-width: 767.98px) {
        .cookie-consent {
            padding: 10px;
        }

        .cookie-consent__content {
            flex-direction: column;
            align-items: stretch;
        }

        .cookie-consent__button {
            width: 100%;
        }
    }
</style>

<script>
    (function () {
        var storageKey = 'ieee_cs_cookie_consent';
        var banner = document.getElementById('cookieConsentBanner');
        var acceptButton = document.getElementById('cookieConsentAccept');

        if (!banner || !acceptButton) {
            return;
        }

        var hasConsent = localStorage.getItem(storageKey) === 'accepted';

        if (!hasConsent) {
            window.requestAnimationFrame(function () {
                banner.classList.add('is-visible');
            });
        }

        acceptButton.addEventListener('click', function () {
            localStorage.setItem(storageKey, 'accepted');
            banner.classList.remove('is-visible');
            banner.classList.add('is-hiding');

            window.setTimeout(function () {
                banner.style.display = 'none';
            }, 420);
        });
    })();
</script>
