<x-base-layout>
    <x-hero title="{{ __('Privacy Policy') }}" background="{{ asset('images/contact_us_2.png') }}" :breadcrumbs="[
        ['label' => 'Privacy Policy'],
    ]" />

    <section class="privacy-policy-page sp">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="privacy-policy-card">
                        <h2>Privacy Policy</h2>
                        <p>
                            This Privacy Policy explains how the IEEE Computer Society Student Chapter website
                            collects, uses, and safeguards personal information when students register for technical
                            bootcamps, workshops, and chapter social events, including Ramadan Iftars.
                        </p>
                        <p>
                            By using this website and submitting registration forms, you agree to the collection and
                            use of information as described in this policy.
                        </p>

                        <h3>1. Information We Collect</h3>
                        <p>When you register for chapter activities, we may collect the following information:</p>
                        <p>
                            Full name, university ID, university email address, phone number (if requested), and
                            event-related responses such as dietary preferences or participation details when required
                            to organize the event.
                        </p>

                        <h3>2. How We Use Your Data</h3>
                        <p>We use collected information only for legitimate chapter operations, including:</p>
                        <p>
                            Processing event and workshop registrations, sending confirmations and logistical updates,
                            managing attendance, sharing chapter communications relevant to your participation, and
                            improving future chapter programs.
                        </p>
                        <p>
                            We do not sell personal information to third parties.
                        </p>

                        <h3>3. Data Protection and Storage</h3>
                        <p>
                            We apply reasonable administrative and technical safeguards to protect personal data from
                            unauthorized access, disclosure, or misuse. Personal information is stored only for as long
                            as needed to support chapter administration, event operations, and university compliance
                            obligations.
                        </p>
                        <p>
                            Access to registration data is limited to authorized chapter officers and faculty advisors
                            who require access for official chapter work.
                        </p>

                        <h3>4. Third-Party Services</h3>
                        <p>
                            This website may contain links to external platforms or IEEE resources. Their privacy
                            practices are governed by their own policies. We encourage you to review those policies
                            directly.
                        </p>

                        <h3>5. Your Choices</h3>
                        <p>
                            You may request to review, update, or delete your submitted personal information where
                            applicable and permitted by university policy.
                        </p>

                        <h3>6. Contact Us</h3>
                        <p>
                            For privacy-related questions or data requests, please contact us at:
                            <a href="mailto:ieeecsbau@ieee.org">chapter-email@example.edu</a>
                        </p>

                        <h3>7. Policy Updates</h3>
                        <p>
                            This Privacy Policy may be updated periodically to reflect changes in chapter operations,
                            legal requirements, or website features. Updates will be posted on this page with a revised
                            effective date.
                        </p>

                        <p><strong>Effective Date:</strong> April 10, 2026</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .privacy-policy-card {
                background: #ffffff;
                border: 1px solid #e8eef4;
                border-radius: 14px;
                box-shadow: 0 14px 38px rgba(3, 31, 58, 0.07);
                padding: 28px;
            }

            .privacy-policy-card h2,
            .privacy-policy-card h3 {
                color: #003b71;
            }

            .privacy-policy-card h2 {
                font-size: 32px;
                margin: 0 0 16px;
            }

            .privacy-policy-card h3 {
                font-size: 20px;
                margin: 24px 0 10px;
            }

            .privacy-policy-card p {
                margin: 0 0 12px;
                color: #33485d;
                font-size: 16px;
                line-height: 1.75;
            }

            .privacy-policy-card a {
                color: #00629b;
                text-decoration: underline;
                text-underline-offset: 2px;
            }

            @media (max-width: 767.98px) {
                .privacy-policy-card {
                    padding: 20px;
                }

                .privacy-policy-card h2 {
                    font-size: 26px;
                }

                .privacy-policy-card h3 {
                    font-size: 18px;
                }

                .privacy-policy-card p {
                    font-size: 15px;
                }
            }
        </style>
    @endpush
</x-base-layout>
