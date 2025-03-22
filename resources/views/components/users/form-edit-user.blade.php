@props(['user'])

<div>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <p class="text-3xl text-neutral-200 pb-5 border-b border-neutral-600">Update your profile informations</p>
        </div>
        <div>
            <x-forms.input-group id="name" name="name" :default-value="$user->name" placeholder="John B. Goode"
                label="Your name" icon="fa-solid fa-user" />
            <x-forms.input-group id="email" name="email" :default-value="$user->email" placeholder="johnbgoode@email.com"
                label="Your best email" icon="fa-solid fa-envelope" />
            <x-forms.input-group type="password" id="password" name="password" label="Set a new password"
                icon="fa-solid fa-lock" />
            <x-forms.input-group type="password" id="password_confirmation" name="password_confirmation"
                label="Password confirmation" icon="fa-solid fa-lock" />
            <div class="mt-8 text-end">
                <button class="btn-blue" type="submit">
                    <i class="fa-solid fa-save me-2"></i>
                    Save
                </button>
            </div>
        </div>
    </form>
</div>
