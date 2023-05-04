# Prova-M7


Aplicación LIsta de Contactos


Nuestra aplicación será de una agenda de contactos personal  donde habrá 4 tablas y 1 vista: usuario, contactos, grupos, contactos_grupos y en la vista tenemos mostrar_fav.

Dentro de cada tabla tenemos lo siguiente:


        - Usuario: id_usuario, nombre_usuario y contraseña.

        - Contactos: id_contacto, nombre, numero, email, direccion, favorito, id_usuario.

        - Grupos: id_grupo, nombre, num_miembros.

        - Contactos_grupos: id_contacto, id_grupo.


Dentro de la vista tenemos lo siguiente:


        - Mostrar_fav: nombre, numero, email, direccion, favorito, id_usuario.

Esta aplicación tiene como primera página un login donde tienes que iniciar sesión con el nombre de usuario y contraseña que está guardado en la base de datos con su respectivo identificador, una vez iniciado aparecerá una pantalla con un menú en la parte superior que nos lleva a sitios diferentes, Contactos, Favoritos y Cerrar sesión. 

En contactos que es la primera página que nos saldrá cuando hemos iniciado sesión tenemos la lista de contactos del usuario que se ha logueado, en el que mostrará el nombre, número, email, dirección, favorito, grupo, editar y eliminar. Y en la parte superior de la lista un botón llamado “Nuevo” donde podemos crear un nuevo contacto.

En la página de nuevo contacto, tenemos un pequeño formulario donde nos pedirá el nombre, número, email, dirección, si queremos marcarlo como favorito y una lista de grupos que están almacenados en la base de datos donde puedes marcar de 0 a varias opciones, una vez hemos rellenado el formulario tenemos un botón donde agrega el contacto a la lista de contactos que mencionamos anteriormente y en la base de datos.

Luego en la siguiente opción del menú tenemos favoritos donde solo mostrará los contactos que están marcados como favoritos en la lista de contactos con su respectivo usuario.

Y como última opción del menú tenemos un cerrar sesión, que al hacer clic nos llevará a la página principal de nuestra aplicación.





