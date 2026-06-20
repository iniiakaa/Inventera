<x-layouts.admin active="settings" title="Settings - Jayusman Retail Management">
 <!-- Page Header -->
 <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 mt-8 md:mt-0">
 <div>
 <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">Configuration Console</p>
 <h2 class="font-display text-display text-on-surface hidden md:block">Settings</h2>
 <h2 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface md:hidden">Settings</h2>
 </div>
 </header>

 <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
 <!-- Main Settings -->
 <div class="xl:col-span-2 space-y-8">

 <!-- Identity Profile -->
 <section class="liquid-glass rounded-xl p-8">
 <div class="flex justify-between items-start mb-8">
 <div>
 <h3 class="font-headline-md text-headline-md text-on-surface">Identity Profile</h3>
 <p class="font-body-md text-body-md text-on-surface-variant mt-1">Publicly visible metadata and identity markers.</p>
 </div>
 <button class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-[0_8px_16px_rgba(0,88,188,0.3)] hover:opacity-90 transition-all">
 Save Changes
 </button>
 </div>

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
 <div class="space-y-2">
 <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Full Display Name</label>
 <input type="text" value="Pak Jayusman" class="w-full bg-white/30 border border-white/40 rounded-xl px-4 py-3 font-body-md text-body-md text-on-surface focus:border-primary/60 outline-none transition backdrop-blur-sm placeholder:text-on-surface-variant">
 </div>
 <div class="space-y-2">
 <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Professional Email</label>
 <input type="email" value="jayusman@retailflow.co.id" class="w-full bg-white/30 border border-white/40 rounded-xl px-4 py-3 font-body-md text-body-md text-on-surface focus:border-primary/60 outline-none transition backdrop-blur-sm placeholder:text-on-surface-variant">
 </div>
 </div>
 <div class="space-y-2">
 <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Professional Bio</label>
 <textarea rows="3" class="w-full bg-white/30 border border-white/40 rounded-xl px-4 py-3 font-body-md text-body-md text-on-surface focus:border-primary/60 outline-none transition backdrop-blur-sm resize-none">Owner of Jayusman Retail Group, overseeing 5 branches across major Indonesian cities.</textarea>
 </div>
 </section>

 <!-- Security Protocols -->
 <section class="liquid-glass rounded-xl p-8">
 <div class="flex items-center space-x-3 mb-8">
 <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
 <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">shield</span>
 </div>
 <div>
 <h3 class="font-headline-md text-headline-md text-on-surface">Security Protocols</h3>
 <p class="font-body-md text-body-md text-on-surface-variant">Protect your workspace with advanced security.</p>
 </div>
 </div>

 <div class="space-y-4">
 <!-- 2FA -->
 <div class="flex items-center justify-between p-4 bg-white/20 rounded-xl border border-white/30">
 <div class="flex items-center space-x-4">
 <div class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
 <span class="material-symbols-outlined text-[18px]">phone_android</span>
 </div>
 <div>
 <p class="font-label-md text-label-md text-on-surface">Two-Factor Authentication</p>
 <p class="font-label-sm text-label-sm text-on-surface-variant">Add an extra layer of security.</p>
 </div>
 </div>
 <div class="w-11 h-6 bg-secondary rounded-full relative cursor-pointer flex-shrink-0">
 <div class="absolute right-1 top-1 bg-white w-4 h-4 rounded-full shadow-sm"></div>
 </div>
 </div>

 <!-- Hardware Key -->
 <div class="flex items-center justify-between p-4 bg-white/20 rounded-xl border border-white/30">
 <div class="flex items-center space-x-4">
 <div class="w-9 h-9 rounded-xl bg-surface-container text-on-surface-variant flex items-center justify-center">
 <span class="material-symbols-outlined text-[18px]">key</span>
 </div>
 <div>
 <p class="font-label-md text-label-md text-on-surface">Hardware Key Support</p>
 <p class="font-label-sm text-label-sm text-on-surface-variant">Use physical keys like Yubikey.</p>
 </div>
 </div>
 <div class="w-11 h-6 bg-surface-container-high rounded-full relative cursor-pointer flex-shrink-0">
 <div class="absolute left-1 top-1 bg-outline w-4 h-4 rounded-full shadow-sm"></div>
 </div>
 </div>
 </div>
 </section>

 <!-- Danger Zone -->
 <section class="rounded-xl p-8 border-2 border-error/20 bg-error-container/20">
 <div class="flex justify-between items-center">
 <div>
 <h3 class="font-headline-md text-headline-md text-error">Danger Zone</h3>
 <p class="font-body-md text-body-md text-on-surface-variant mt-1">Irreversible actions for your workspace account.</p>
 </div>
 <button class="px-5 py-2.5 border border-error text-error rounded-full font-label-md text-label-md hover:bg-error/10 transition-all">
 Deactivate Workspace
 </button>
 </div>
 </section>
 </div>

 <!-- Sidebar Panels -->
 <div class="space-y-8">
 <!-- Notification Logic -->
 <section class="liquid-glass rounded-xl p-8">
 <h3 class="font-headline-md text-headline-md text-on-surface mb-6">Notification Logic</h3>
 <div class="space-y-5">
 @php
 $notifs = [
 ['label' => 'Critical Alerts', 'active' => true],
 ['label' => 'Team Mentions', 'active' => true],
 ['label' => 'Daily Digest', 'active' => false],
 ['label' => 'Marketing Comms', 'active' => false],
 ];
 @endphp
 @foreach($notifs as $notif)
 <div class="flex justify-between items-center">
 <span class="font-body-md text-body-md text-on-surface">{{ $notif['label'] }}</span>
 <div class="w-11 h-6 {{ $notif['active'] ? 'bg-secondary' : 'bg-surface-container-high' }} rounded-full relative cursor-pointer flex-shrink-0">
 <div class="absolute {{ $notif['active'] ? 'right-1' : 'left-1' }} top-1 bg-white w-4 h-4 rounded-full shadow-sm transition-all"></div>
 </div>
 </div>
 @endforeach
 </div>
 </section>

 <!-- Active Session -->
 <section class="liquid-glass rounded-xl p-8">
 <p class="font-label-sm text-label-sm text-primary uppercase tracking-wider">Active Session</p>
 <div class="flex items-baseline space-x-2 mt-3">
 <span class="font-display text-display text-on-surface">12</span>
 <span class="font-body-md text-body-md text-on-surface-variant">Days Uptime</span>
 </div>
 <div class="flex items-center space-x-2 mt-4">
 <div class="w-2 h-2 rounded-full bg-secondary"></div>
 <span class="font-label-sm text-label-sm text-on-surface-variant">Verified Connection: Jakarta, ID</span>
 </div>
 <button class="w-full mt-8 py-3 px-4 liquid-glass rounded-full text-error font-label-md text-label-md hover:bg-error/10 transition-all">
 Terminate All Sessions
 </button>
 </section>
 </div>
 </div>
 <div class="pb-12"></div>
</x-layouts.admin>
