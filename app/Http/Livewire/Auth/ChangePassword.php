<?php

namespace App\Http\Livewire\Auth;

use Filament\Facades\Filament;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use JeffGreco13\FilamentBreezy\FilamentBreezy;
use Livewire\Component;

class ChangePassword extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $current_password;

    public $password;

    public $password_confirm;

    public function mount()
    {
        //        if (Filament::auth()->check()) {
        //            return redirect(config("filament.home_url"));
        //        }
    }

    public function messages(): array
    {
        return [
            'email.unique' => __('filament-breezy::default.registration.notification_unique'),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('current_password')
                ->label('Current Password')
                ->required()
                ->password()
                ->rules('current_password:web'),
            Forms\Components\TextInput::make('password')
                ->label(__('filament-breezy::default.fields.password'))
                ->required()
                ->password()
                ->rules(app(FilamentBreezy::class)->getPasswordRules()),
            Forms\Components\TextInput::make('password_confirm')
                ->label(__('filament-breezy::default.fields.password_confirm'))
                ->required()
                ->password()
                ->same('password'),
        ];
    }

    protected function prepareModelData($data): array
    {
        $preparedData = [
            'password' => Hash::make($data['password']),
            'password_confirmed_at' => now(),
        ];

        return $preparedData;
    }

    public function changePassword()
    {
        $preparedData = $this->prepareModelData($this->form->getState());

        $user = auth()->user();

        $user->update($preparedData);

        //        Filament::auth()->login($user->fresh(), true);

        return redirect()->to('/'.config('filament.path'));
    }

    public function render(): View
    {
        $view = view('filament-breezy::change-password');

        $view->layout('filament::components.layouts.base', [
            'title' => __('Change Password'),
        ]);

        return $view;
    }
}
