<p align="center">
<img src="./images/template/logo.png" width="300">
</p>

# Symfofilms - Página de películas

Symfofilms es una página de películas desarrollada con Symfony y Bootstrap, la cual te permite poder añadir, ver, editar y eliminar películas, todo con una base de datos gestionada por MariaDB, también te permite registrarte y loguearte como usuario.

### _Tabla de contenidos:_
* **[1]  [Resumen](#resumen-)**
* **[2]  [Estructura del proyecto](#estructura-del-proyecto-)**
* **[3]  [Instalación](#instalación-)**
* **[4]  [Autor](#autor-)**

## Resumen 📋

Este proyecto es una aplicación web muy intuitiva y *user friendly* que te permite gestionar películas. Symfoflims cuenta con los siguientes apartados:
*   Cabecera
    * Muestra frases de películas famosas y entrañables.
    * Muestra los enlaces de logueo y registro en caso de que no tengas una cuenta, caso contrario muestra el correo del usuario logueado, así como un enlace para cerrar sesión.
*   Portada
    * Muestra todas las películas agregadas recientemente por los usuarios.
    * Cuenta con una paginación para poder ver todas las películas de una manera rápida.
*   Lista de películas
    * Muestra todas las películas agregadas recientemente por los usuarios, pero esta vez con más detalles, así como enlaces para poder ver, editar o eliminar la película dependiendo del rol que el usuario posea.
    * Cuenta con una paginación para poder ver todas las películas de una manera rápida, así como información de cuántas películas existen y de acuerdo a ello, cuántas páginas debe haber.
*   Nueva película (solo para usuarios identificados)
    * Permite al usuario agregar una nueva película a la base de datos a través de un formulario, así como poder agregar una imagen de la misma y visualizarla antes de añadirla, caso contrario se agregará la película con una imagen por defecto.
*   Buscar película
    * Muestra la misma información que se puede ver en la lista de películas, con la diferencia de que justo arriba de la información se puede apreciar un formulario de búsqueda, el cual, valga la redundancia, permite al usuario aplicar filtros de búsqueda y así obtener información más precisa.
*   Lista de actores
    * Muestra a todos los actores agregados recientemente por los usuarios, así como enlaces para poder ver, editar o eliminar al actor dependiendo del rol que el usuario posea.
*   Nuevo actor (solo para usuarios identificados)
    * Permite al usuario agregar a un nuevo actor a la base de datos a través de un formulario, así como poder agregar una imagen del mismo y visualizarla antes de añadirla, caso contrario se agregará al actor con una imagen por defecto.
*   Buscar actor
    * Muestra la misma información que se puede ver en la lista de actores, con la diferencia de que justo arriba de la información se puede apreciar un formulario de búsqueda, el cual, valga la redundancia, permite al usuario aplicar filtros de búsqueda y así obtener información más precisa.
*   Contacto
    * Permite al usuario poder enviar un correo electrónico sobre cualquier duda a Symfofilms.

## Estructura del proyecto 📐
Si bien es cierto que el proyecto se constituye básicamente de Symfony y Bootstrap, también se usó Twig para la parte de las vistas, así como un pequeño código de JavaScript para poder visualizar la imagen de la película o el actor en los formularios de creación y edición de los mismos.

- **Symfofilms:**  
Construido principalmente sobre [Symfony](https://symfony.com/), [Bootstrap](https://getbootstrap.com/).  
Aplicación diseñada para poder gestionar películas, donde también se usó [Twig](https://twig.symfony.com/) para las vistas de cada entidad, teniendo cada una un CRUD, una base datos gestionada por [MariaDB](https://mariadb.org/) para poder almacenar los datos allí y por último, también se usó una función de JavaScript, la cual te permite poder visualizar una imagen al seleccionarla.

## Instalación 💻

_En la siguiente sección se explica qué se necesita para ejecutar la aplicación_   

-- [Node](https://nodejs.org/es/)

-- [XAMPP](https://www.apachefriends.org/es/index.html) (_contiene Apache, PHP y MariaDB._)

-- [Composer](https://getcomposer.org/)

-- [Visual Studio Code](https://code.visualstudio.com/)

-- [Google Chrome](https://www.google.com/intl/es_es/chrome/) (_o cualquier navegador equivalente._)   

## Autor ✒️

- **Kevin Larriega Palomino**  
--   kevinlarriega@gmail.com  
--   https://github.com/kevinlarriega  
--   https://github.com/KevinCIFO  
