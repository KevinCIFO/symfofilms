<?php

namespace App\Service;

class FrasesService {
    public function getFraseAleatoria():String {
        $frases = [
            'Que la fuerza te acompañe.',
            'Hasta la vista, Baby.',
            'Mi nombre es Bond, James Bond.',
            'Yo sólo puedo mostrarte la puerta, tú tienes que atravesarla.',
            'Le haré una oferta que no podrá rechazar.',
            '¡Aquí está Johnny!',
            '¿Acaso no lo viste venir?',
            'Un gran poder conlleva una gran responsabilidad.',
            'La vida no se trata de cuan fuerte golpees, sino de cuan fuerte seas golpeado y no te des por vencido.',
            'Haría esto todo el día.'
        ];

        return $frases[array_rand($frases)];
    }

    public function replace(UploadedFile $file, ?String $anterior):String {
        $extension = $file->guessExtension();
        $fichero = uniqid().".$extension";

        try {
            $file->move($this->targetDirectory, $fichero);

            if($anterior){
                $filesystem = new Filesystem();
                $filesystem->remove("$this->targetDirectory/$anterior");
            }
        } catch(FileException $e) {
            return $anterior;
        }

        return $fichero;
    }

    public function delete(String $fichero) {
        $filesystem = new Filesystem();
        $filesystem->remove("$this->targetDirectory/$fichero");
    }
}