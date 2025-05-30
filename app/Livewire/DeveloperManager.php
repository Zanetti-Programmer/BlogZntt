<?php

namespace App\Livewire;

use App\Models\Developer;
use Livewire\Component;
use Livewire\WithFileUploads;

class DeveloperManager extends Component
{
    use WithFileUploads;

    public $developerId;
    public $nome;
    public $email;
    public $foto;
    public $novaFoto;
    public $biografia;

    public $modoEdicao = false;

    protected $rules = [
        'nome' => 'required|string|max:255',
        'email' => 'required|email|unique:developers,email',
        'biografia' => 'nullable|string',
        'novaFoto' => 'nullable|image|max:2048',
    ];

    public function render()
    {
        return view('livewire.developer-manager', [
            'developers' => Developer::latest()->get()
        ]);
    }

    public function salvar()
    {
        $this->validate();

        $fotoPath = null;
        if ($this->novaFoto) {
            $fotoPath = $this->novaFoto->store('fotos', 'public');
        }

        Developer::create([
            'nome' => $this->nome,
            'email' => $this->email,
            'foto' => $fotoPath,
            'biografia' => $this->biografia,
        ]);

        $this->resetForm();
    }

    public function editar($id)
    {
        $dev = Developer::findOrFail($id);
        $this->developerId = $dev->id;
        $this->nome = $dev->nome;
        $this->email = $dev->email;
        $this->foto = $dev->foto;
        $this->biografia = $dev->biografia;
        $this->modoEdicao = true;

        $this->resetValidation();
    }

    public function atualizar()
    {
        $rules = $this->rules;
        $rules['email'] = 'required|email|unique:developers,email,' . $this->developerId;

        $this->validate($rules);

        $dev = Developer::findOrFail($this->developerId);

        if ($this->novaFoto) {
            $fotoPath = $this->novaFoto->store('fotos', 'public');
            $dev->foto = $fotoPath;
        }

        $dev->update([
            'nome' => $this->nome,
            'email' => $this->email,
            'foto' => $dev->foto,
            'biografia' => $this->biografia,
        ]);

        $this->resetForm();
    }

    public function deletar($id)
    {
        Developer::destroy($id);
    }

    public function resetForm()
    {
        $this->reset(['developerId', 'nome', 'email', 'foto', 'biografia', 'novaFoto', 'modoEdicao']);
        $this->resetValidation();
    }
}
