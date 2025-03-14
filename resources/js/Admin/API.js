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
    create_categoria: '/create_categoria',
    edit_categoria: '/edit_categoria',
    delete_categoria: '/delete_categoria',

    // CATEGORIAS
    get_subcategorias: '/get_subcategorias',
    create_subcategoria: '/create_subcategoria',
    edit_subcategoria: '/edit_subcategoria',
    delete_subcategoria: '/delete_subcategoria',

    // PRODUCTOS
    get_producto_by_id: '/get_producto_by_id',
    get_productos: '/get_productos',
    create_producto: '/create_producto',
    edit_producto: '/edit_producto',
    edit_producto_destacado: '/edit_producto_destacado',
    add_imagenes_producto: '/add_imagenes_producto',
    delete_imagen_producto: '/delete_imagen_producto',
    delete_producto: '/delete_producto',

    // MARCAS
    get_marcas: '/get_marcas',
    create_marca: '/create_marca',
    edit_marca: '/edit_marca',
    delete_marca: '/delete_marca',

};

export default API_ADMIN;
