<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Developer;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ArticleManager extends Component
{
    use WithFileUploads;

    public $articleId;
    public $titulo;
    public $conteudo;
    public $capa;
    public $novaCapa;
    public $data_publicacao;
    public $desenvolvedores = [];
    public $previewUrl;

    public $modoEdicao = false;

    protected $rules = [
        'titulo' => 'required|string|max:255',
        'conteudo' => 'required|string',
        'data_publicacao' => 'nullable|date',
        'novaCapa' => 'nullable|image|max:2048',
        'desenvolvedores' => 'array',
    ];

    public function render()
    {
        return view('livewire.article-manager', [
            'articles' => Article::with('developers')->latest()->get(),
            'allDevelopers' => Developer::all(),
        ]);
    }

    public function salvar()
    {
        $this->validate();

        $capaPath = $this->novaCapa ? $this->novaCapa->store('capas', 'public') : null;

        $article = Article::create([
            'titulo' => $this->titulo,
            'conteudo' => $this->conteudo,
            'capa' => $capaPath,
            'data_publicacao' => $this->data_publicacao,
        ]);

        $article->developers()->sync($this->desenvolvedores);

        session()->flash('message', 'Artigo criado com sucesso!');
        $this->resetForm();
    }

    public function editar($id)
    {
        $article = Article::with('developers')->findOrFail($id);

        $this->articleId = $article->id;
        $this->titulo = $article->titulo;
        $this->conteudo = $article->conteudo;
        $this->capa = $article->capa;
        $this->data_publicacao = $article->data_publicacao?->format('Y-m-d\TH:i');
        $this->desenvolvedores = $article->developers->pluck('id')->toArray();
        $this->modoEdicao = true;

        $this->resetValidation();
    }

    public function atualizar()
    {
        $this->validate();

        $article = Article::findOrFail($this->articleId);

        // Se há nova capa, deletar a antiga e salvar a nova
        if ($this->novaCapa) {
            // Deletar capa antiga se existir
            if ($article->capa) {
                Storage::disk('public')->delete($article->capa);
            }
            $capaPath = $this->novaCapa->store('capas', 'public');
        } else {
            // Manter a capa atual
            $capaPath = $article->capa;
        }

        $article->update([
            'titulo' => $this->titulo,
            'conteudo' => $this->conteudo,
            'capa' => $capaPath,
            'data_publicacao' => $this->data_publicacao,
        ]);

        $article->developers()->sync($this->desenvolvedores);

        session()->flash('message', 'Artigo atualizado com sucesso!');
        $this->resetForm();
    }

    public function deletar($id)
    {
        $article = Article::findOrFail($id);
        
        // Deletar a imagem se existir
        if ($article->capa) {
            Storage::disk('public')->delete($article->capa);
        }
        
        $article->delete();
        
        session()->flash('message', 'Artigo excluído com sucesso!');
    }

    // Métodos para preview de imagem
    public function previewImage($event)
    {
        $this->validateOnly('novaCapa');
    }
    
    public function clearImagePreview()
    {
        $this->novaCapa = null;
        $this->previewUrl = null;
        $this->dispatch('imagePreviewCleared');
    }
    
    public function updatedNovaCapa()
    {
        $this->validateOnly('novaCapa');
        
        if ($this->novaCapa) {
            try {
                // Criar URL temporária para preview
                $this->previewUrl = $this->novaCapa->temporaryUrl();
                $this->dispatch('imagePreviewUpdated', $this->previewUrl);
            } catch (\Exception $e) {
                // Se não conseguir criar URL temporária, limpar
                $this->previewUrl = null;
            }
        }
    }

    public function resetForm()
    {
        $this->reset([
            'articleId', 
            'titulo', 
            'conteudo', 
            'capa', 
            'novaCapa', 
            'data_publicacao', 
            'desenvolvedores', 
            'modoEdicao',
            'previewUrl'
        ]);
        $this->resetValidation();
        $this->dispatch('imagePreviewCleared');
    }
}