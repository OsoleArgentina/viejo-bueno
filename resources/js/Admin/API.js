const API_ADMIN = {
    logout: '/logout',  
    
    // slider - HOME
    get_sliders: '/get_sliders',  
    set_slider: '/set_slider',  
    delete_slider: '/delete_slider',
    edit_slider: '/edit_slider',
    // nosotros - HOME
    get_home_nosotros: '/get_home_nosotros',
    set_home_nosotros: '/set_home_nosotros',

    // NOSOTROS
    get_nosotros: '/get_nosotros',
    set_nosotros: '/set_nosotros',
    // NOSOTROS ELEGIRNOS
    get_nosotros_elegirnos: '/get_nosotros_elegirnos',
    create_elegirnos: '/create_elegirnos',
    edit_elegirnos: '/edit_elegirnos',
    delete_elegirnos: '/delete_elegirnos',

    // CATEGORIAS
    get_categorias: '/get_categorias',
    get_categorias_destacadas: '/get_categorias_destacadas',
    create_categoria: '/create_categoria',
    edit_categoria: '/edit_categoria',
    delete_categoria: '/delete_categoria',

    // CATEGORIAS
    get_subcategorias: '/get_subcategorias',
    create_subcategoria: '/create_subcategoria',
    edit_subcategoria: '/edit_subcategoria',
    edit_categoria_destacado: '/edit_categoria_destacado',
    delete_subcategoria: '/delete_subcategoria',

    // PRODUCTOS
    get_producto_by_id: '/get_producto_by_id',
    get_productos_relacionados: '/get_productos_relacionados',
    get_productos: '/get_productos',
    get_productos_destacadas: '/get_productos_destacadas',
    create_producto: '/create_producto',
    edit_producto: '/edit_producto',
    edit_producto_destacado: '/edit_producto_destacado',
    add_imagenes_producto: '/add_imagenes_producto',
    delete_imagen_producto: '/delete_imagen_producto',
    delete_producto: '/delete_producto',

    // MARCAS
    get_marcas: '/get_marcas',
    get_marcas_destacadas: '/get_marcas_destacadas',
    create_marca: '/create_marca',
    edit_marca: '/edit_marca',
    edit_marca_destacado: '/edit_marca_destacado',
    delete_marca: '/delete_marca',

    // NOVEDADES
    get_novedades: '/get_novedades',
    create_novedad: '/create_novedad',
    edit_novedad: '/edit_novedad',
    delete_novedad: '/delete_novedad',

    // CAPACITACIONES
    get_capacitaciones: '/get_capacitaciones',
    create_capacitacion: '/create_capacitacion',
    edit_capacitacion: '/edit_capacitacion',
    delete_capacitacion: '/delete_capacitacion',

    // CONTACTO
    get_contacto: '/get_contacto',
    set_contacto: '/set_contacto',

    // ADMINS
    get_admins: '/get_admins',
    create_admin: '/create_admin',
    edit_super_admin: '/edit_super_admin',
    edit_admin: '/edit_admin',
    delete_admin: '/delete_admin',

    // METADATOS
    get_metadatos: '/get_metadatos',
    edit_metadato: '/edit_metadato',

    // MERCADO PAGO
    createPreference: '/createPreference',

    // CARRITO
    create_pedido: '/create_pedido',

};

export default API_ADMIN;
