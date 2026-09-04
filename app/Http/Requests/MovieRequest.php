<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Senza un sistema ACL  o di autenticazione richiesto autorizziamo di default tutte le richieste.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $idMovie = $this->route('movie') ? $this->route('movie')->id : null;
        return [
            'title' => [
                'required',
                'string',
                'max:100',
                Rule::unique('movies', 'title')
                    ->where('release_year', $this->input('release_year'))
                    ->ignore($idMovie), // ignoriamo il film corrente evitando di far scattare il validator unique sul film che stiamo modificando
            ],
            'release_year' => [
                'required',
                'integer',
                'min:1895',
                'max:' . now()->year,
            ],
            'director'     => 'required|string|max:50',
            'genre'        => 'required|string|max:30',
            'cast'         => 'required|array|min:1|max:30',
            'cast.*'       => 'required|string|max:50',
            'plot'         => 'required|string|max:5000',
        ];
    }

    public function messages(): array
    {
        return [
            'title.unique'         => 'Un film con questo titolo e questo anno di uscita è già presente.',
            'title.required'       => 'Il titolo del film è obbligatorio.',
            'director.required'    => 'Il regista del film è obbligatorio.',
            'genre.required'       => 'Il genere del film è obbligatorio.',
            'release_year.min'     => "L'anno di uscita non può essere precedente al 1895.",
            'release_year.max'     => "L'anno di uscita non può essere successiva all'anno corrente",
            'cast.required'        => 'Devi inserire almeno un membro del cast.',
            'cast.min'             => 'Aggiungi almeno un attore al cast.',
            'cast.*.required'      => 'Il nome dell\'attore non può essere vuoto.',
            'plot.required'        => 'La trama del film è obbligatoria.',
        ];
    }
}
