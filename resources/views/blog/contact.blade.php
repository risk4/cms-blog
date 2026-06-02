@extends('layouts.blog')

@section('content')
@php
    $contact = $contact ?? [];
@endphp

<div class="bg-gray-50 py-16 dark:bg-gray-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-10 text-center">
            <p class="mb-3 text-sm font-semibold uppercase tracking-wider text-brand-500">Contact Us</p>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">Get in touch with us</h1>
            <p class="mx-auto mt-4 max-w-2xl text-base text-gray-600 dark:text-gray-400">
                Send us a message, ask a question, or visit our office using the details below.
            </p>
        </div>

        <div class="grid gap-8 lg:grid-cols-[380px_minmax(0,1fr)] xl:grid-cols-[400px_minmax(0,1fr)]">
            <!-- Contact Information -->
            <div class="space-y-6">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Contact Information</h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Reach us through any of the channels below.</p>

                    <div class="mt-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 flex h-10 w-10 items-center justify-center rounded-lg bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Email</p>
                                <a href="mailto:{{ $contact['email'] ?? '' }}" class="text-sm text-gray-600 hover:text-brand-500 dark:text-gray-300 dark:hover:text-brand-400">
                                    {{ $contact['email'] ?? '-' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 flex h-10 w-10 items-center justify-center rounded-lg bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h3a1.5 1.5 0 0 0 1.5-1.5v-1.372a1.5 1.5 0 0 0-1.123-1.45l-3.812-.953a1.5 1.5 0 0 0-1.743.75l-.5.832a12.235 12.235 0 0 1-5.677-5.677l.832-.5a1.5 1.5 0 0 0 .75-1.743l-.953-3.812a1.5 1.5 0 0 0-1.45-1.123H3.75a1.5 1.5 0 0 0-1.5 1.5v3Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Phone</p>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contact['phone'] ?? '') }}" class="text-sm text-gray-600 hover:text-brand-500 dark:text-gray-300 dark:hover:text-brand-400">
                                    {{ $contact['phone'] ?? '-' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 flex h-10 w-10 items-center justify-center rounded-lg bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.17-7.5 11.25-7.5 11.25S4.5 17.67 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Address</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ $contact['address'] ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 flex h-10 w-10 items-center justify-center rounded-lg bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Working Hours</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300 whitespace-pre-line">
                                    {{ $contact['hours'] ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Our Location</h2>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Find us on the map below.</p>
                    </div>

                    @if(!empty($contact['maps_embed']))
                        <div class="aspect-[4/3] w-full">
                            <iframe
                                src="{{ $contact['maps_embed'] }}"
                                class="h-full w-full"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    @else
                        <div class="p-6 text-sm text-gray-500 dark:text-gray-400">
                            Google Maps location is not configured yet.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Contact Form -->
            <div class="min-w-0">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700 sm:p-8 w-full">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Send Message</h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Fill out the form below and we’ll get back to you as soon as possible.
                    </p>

                    <form action="#" method="POST" class="mt-8 space-y-6">
                        @csrf

                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="min-w-0">
                                <label for="name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Your Name</label>
                                <input type="text" id="name" name="name" required
                                       class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500"
                                       placeholder="John Doe">
                            </div>

                            <div class="min-w-0">
                                <label for="email" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                                <input type="email" id="email" name="email" required
                                       class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500"
                                       placeholder="you@example.com">
                            </div>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="min-w-0">
                                <label for="phone" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                                <input type="text" id="phone" name="phone"
                                       class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500"
                                       placeholder="+62 812 3456 7890">
                            </div>

                            <div class="min-w-0">
                                <label for="subject" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Subject</label>
                                <input type="text" id="subject" name="subject" required
                                       class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500"
                                       placeholder="How can we help?">
                            </div>
                        </div>

                        <div>
                            <label for="message" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                            <textarea id="message" name="message" rows="7" required
                                      class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500"
                                      placeholder="Write your message here..."></textarea>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                By submitting this form, you agree to be contacted regarding your inquiry.
                            </p>
                            <button type="submit"
                                    class="inline-flex items-center rounded-lg bg-brand-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <div class="mt-8 rounded-2xl bg-brand-50 p-6 ring-1 ring-brand-100 dark:bg-brand-500/10 dark:ring-brand-500/20">
                    <h3 class="text-base font-semibold text-brand-900 dark:text-brand-200">Need an immediate response?</h3>
                    <p class="mt-2 text-sm text-brand-800 dark:text-brand-300">
                        For urgent matters, call us directly or send an email. We usually respond within one business day.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection