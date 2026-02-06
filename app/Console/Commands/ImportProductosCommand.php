<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Precio;
use Illuminate\Support\Str;

class ImportProductosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:productos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa productos creando categorías y subcategorías automáticamente';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // EJEMPLO DE ESTRUCTURA - REEMPLAZAR CON LOS DATOS REALES
        $productosJson = <<<'JSON'
[
                            {
                                "categoria": "Duvet Insert",
                                "subcategoria": "Duvet Insert Algodón",
                                "nombre": "Duvet Insert Algodón",
                                "descripcion": "Duvet insert de algodón, ligero, transpirable y confortable.",
                                "detalles": "Nuestro duvet insert de algodón está diseñado para brindar un excelente nivel de confort, suavidad y transpirabilidad. Gracias a su composición en algodón, permite una óptima circulación del aire, ofreciendo una sensación fresca y agradable durante el descanso.",
                                "color": "Blanco",
                                "marca": "Algodón T200",
                                "talla": "Full , Queen , King",
                                "tags": "duvet insert, algodón"
                            },
                            {
                                "categoria": "Duvet Insert",
                                "subcategoria": "Duvet Insert Microfibra",
                                "nombre": "Duvet Insert Microfibra",
                                "descripcion": "Duvet insert de microfibra, ligero y suave.",
                                "detalles": "Nuestro duvet insert de microfibra está diseñado para ofrecer una sensación suave, ligera y de alto confort. Su relleno de microfibra de alta calidad proporciona un abrigo uniforme, excelente recuperación de forma y gran ligereza, permitiendo un descanso cómodo durante toda la noche.",
                                "color": "Blanco",
                                "marca": "Microfibra 85GSM",
                                "talla": "Twin , Full , Queen , King",
                                "tags": "duvet insert, microfibra"
                            },
                            {
                                "categoria": "Frazadas",
                                "subcategoria": "Frazada Luxury Flannel",
                                "nombre": "Frazada Luxury Flannel tamaño Full/Queen - Azul",
                                "descripcion": "Frazada Luxury Flannel, suave, cálida y elegante. Disponible en 3 tamaños y en tonos blanco, azul, brown y gris. Ideal para uso hotelero y hogar.",
                                "detalles": "Nuestra Frazada Luxury Flannel está diseñada para brindar un máximo nivel de suavidad, calidez y confort. Su textura tipo flannel de alta calidad ofrece una sensación acogedora y ligera, perfecta para complementar la cama en temporadas frescas o como pieza decorativa.\n\nDisponible en tres tamaños y en los tonos blanco, azul, brown y gris, permite adaptarse a diferentes estilos de habitación, manteniendo siempre una presentación elegante y moderna. Su material es duradero, suave al tacto y de fácil mantenimiento, garantizando una excelente experiencia de uso y larga vida útil.",
                                "color": "Azul",
                                "marca": "Flannel",
                                "talla": "Full , Queen",
                                "tags": "frazada, flannel, azul"
                            },
                            {
                                "categoria": "Frazadas",
                                "subcategoria": "Frazada Luxury Flannel",
                                "nombre": "Frazada Luxury Flannel tamaño King - Azul",
                                "descripcion": "Frazada Luxury Flannel, suave, cálida y elegante. Disponible en 3 tamaños y en tonos blanco, azul, brown y gris. Ideal para uso hotelero y hogar.",
                                "detalles": "Nuestra Frazada Luxury Flannel está diseñada para brindar un máximo nivel de suavidad, calidez y confort. Su textura tipo flannel de alta calidad ofrece una sensación acogedora y ligera, perfecta para complementar la cama en temporadas frescas o como pieza decorativa.\n\nDisponible en tres tamaños y en los tonos blanco, azul, brown y gris, permite adaptarse a diferentes estilos de habitación, manteniendo siempre una presentación elegante y moderna. Su material es duradero, suave al tacto y de fácil mantenimiento, garantizando una excelente experiencia de uso y larga vida útil.",
                                "color": "Azul",
                                "marca": "Flannel",
                                "talla": "King",
                                "tags": "frazada, flannel, azul"
                            },
                            {
                                "categoria": "Frazadas",
                                "subcategoria": "Frazada Luxury Flannel",
                                "nombre": "Frazada Luxury Flannel tamaño Twin - Azul",
                                "descripcion": "Frazada Luxury Flannel, suave, cálida y elegante. Disponible en 3 tamaños y en tonos blanco, azul, brown y gris. Ideal para uso hotelero y hogar.",
                                "detalles": "Nuestra Frazada Luxury Flannel está diseñada para brindar un máximo nivel de suavidad, calidez y confort. Su textura tipo flannel de alta calidad ofrece una sensación acogedora y ligera, perfecta para complementar la cama en temporadas frescas o como pieza decorativa.\n\nDisponible en tres tamaños y en los tonos blanco, azul, brown y gris, permite adaptarse a diferentes estilos de habitación, manteniendo siempre una presentación elegante y moderna. Su material es duradero, suave al tacto y de fácil mantenimiento, garantizando una excelente experiencia de uso y larga vida útil.",
                                "color": "Azul",
                                "marca": "Flannel",
                                "talla": "Twin",
                                "tags": "frazada, flannel, azul"
                            },
                            {
                                "categoria": "Frazadas",
                                "subcategoria": "Frazada Luxury Flannel",
                                "nombre": "Frazada Luxury Flannel Full/Queen - Brown",
                                "descripcion": "Frazada Luxury Flannel, suave, cálida y elegante. Disponible en 3 tamaños y en tonos blanco, azul, brown y gris. Ideal para uso hotelero y hogar.",
                                "detalles": "Nuestra Frazada Luxury Flannel está diseñada para brindar un máximo nivel de suavidad, calidez y confort. Su textura tipo flannel de alta calidad ofrece una sensación acogedora y ligera, perfecta para complementar la cama en temporadas frescas o como pieza decorativa.\n\nDisponible en tres tamaños y en los tonos blanco, azul, brown y gris, permite adaptarse a diferentes estilos de habitación, manteniendo siempre una presentación elegante y moderna. Su material es duradero, suave al tacto y de fácil mantenimiento, garantizando una excelente experiencia de uso y larga vida útil.",
                                "color": "Brown",
                                "marca": "Flannel",
                                "talla": "Full , Queen",
                                "tags": "frazada, flannel, brown"
                            },
                            {
                                "categoria": "Frazadas",
                                "subcategoria": "Frazada Luxury Flannel",
                                "nombre": "Frazada Luxury Flannel King - Brown",
                                "descripcion": "Frazada Luxury Flannel, suave, cálida y elegante. Disponible en 3 tamaños y en tonos blanco, azul, brown y gris. Ideal para uso hotelero y hogar.",
                                "detalles": "Nuestra Frazada Luxury Flannel está diseñada para brindar un máximo nivel de suavidad, calidez y confort. Su textura tipo flannel de alta calidad ofrece una sensación acogedora y ligera, perfecta para complementar la cama en temporadas frescas o como pieza decorativa.\n\nDisponible en tres tamaños y en los tonos blanco, azul, brown y gris, permite adaptarse a diferentes estilos de habitación, manteniendo siempre una presentación elegante y moderna. Su material es duradero, suave al tacto y de fácil mantenimiento, garantizando una excelente experiencia de uso y larga vida útil.",
                                "color": "Brown",
                                "marca": "Flannel",
                                "talla": "King",
                                "tags": "frazada, flannel, brown"
                            },
                            {
                                "categoria": "Frazadas",
                                "subcategoria": "Frazada Luxury Flannel",
                                "nombre": "Frazada Luxury Flannel Twin - Brown",
                                "descripcion": "Frazada Luxury Flannel, suave, cálida y elegante. Disponible en 3 tamaños y en tonos blanco, azul, brown y gris. Ideal para uso hotelero y hogar.",
                                "detalles": "Nuestra Frazada Luxury Flannel está diseñada para brindar un máximo nivel de suavidad, calidez y confort. Su textura tipo flannel de alta calidad ofrece una sensación acogedora y ligera, perfecta para complementar la cama en temporadas frescas o como pieza decorativa.\n\nDisponible en tres tamaños y en los tonos blanco, azul, brown y gris, permite adaptarse a diferentes estilos de habitación, manteniendo siempre una presentación elegante y moderna. Su material es duradero, suave al tacto y de fácil mantenimiento, garantizando una excelente experiencia de uso y larga vida útil.",
                                "color": "Brown",
                                "marca": "Flannel",
                                "talla": "Twin",
                                "tags": "frazada, flannel, brown"
                            },
                            {
                                "categoria": "Frazadas",
                                "subcategoria": "Frazada Luxury Flannel",
                                "nombre": "Frazada Luxury Flannel Full/Queen - Gris",
                                "descripcion": "Frazada Luxury Flannel, suave, cálida y elegante. Disponible en 3 tamaños y en tonos blanco, azul, brown y gris. Ideal para uso hotelero y hogar.",
                                "detalles": "Nuestra Frazada Luxury Flannel está diseñada para brindar un máximo nivel de suavidad, calidez y confort. Su textura tipo flannel de alta calidad ofrece una sensación acogedora y ligera, perfecta para complementar la cama en temporadas frescas o como pieza decorativa.\n\nDisponible en tres tamaños y en los tonos blanco, azul, brown y gris, permite adaptarse a diferentes estilos de habitación, manteniendo siempre una presentación elegante y moderna. Su material es duradero, suave al tacto y de fácil mantenimiento, garantizando una excelente experiencia de uso y larga vida útil.",
                                "color": "Gris",
                                "marca": "Flannel",
                                "talla": "Full , Queen",
                                "tags": "frazada, flannel, gris"
                            },
                            {
                                "categoria": "Frazadas",
                                "subcategoria": "Frazada Luxury Flannel",
                                "nombre": "Frazada Luxury Flannel King - Gris",
                                "descripcion": "Frazada Luxury Flannel, suave, cálida y elegante. Disponible en 3 tamaños y en tonos blanco, azul, brown y gris. Ideal para uso hotelero y hogar.",
                                "detalles": "Nuestra Frazada Luxury Flannel está diseñada para brindar un máximo nivel de suavidad, calidez y confort. Su textura tipo flannel de alta calidad ofrece una sensación acogedora y ligera, perfecta para complementar la cama en temporadas frescas o como pieza decorativa.\n\nDisponible en tres tamaños y en los tonos blanco, azul, brown y gris, permite adaptarse a diferentes estilos de habitación, manteniendo siempre una presentación elegante y moderna. Su material es duradero, suave al tacto y de fácil mantenimiento, garantizando una excelente experiencia de uso y larga vida útil.",
                                "color": "Gris",
                                "marca": "Flannel",
                                "talla": "King",
                                "tags": "frazada, flannel, gris"
                            },
                            {
                                "categoria": "Frazadas",
                                "subcategoria": "Frazada Luxury Flannel",
                                "nombre": "Frazada Luxury Flannel Twin - Gris",
                                "descripcion": "Frazada Luxury Flannel, suave, cálida y elegante. Disponible en 3 tamaños y en tonos blanco, azul, brown y gris. Ideal para uso hotelero y hogar.",
                                "detalles": "Nuestra Frazada Luxury Flannel está diseñada para brindar un máximo nivel de suavidad, calidez y confort. Su textura tipo flannel de alta calidad ofrece una sensación acogedora y ligera, perfecta para complementar la cama en temporadas frescas o como pieza decorativa.\n\nDisponible en tres tamaños y en los tonos blanco, azul, brown y gris, permite adaptarse a diferentes estilos de habitación, manteniendo siempre una presentación elegante y moderna. Su material es duradero, suave al tacto y de fácil mantenimiento, garantizando una excelente experiencia de uso y larga vida útil.",
                                "color": "Gris",
                                "marca": "Flannel",
                                "talla": "Twin",
                                "tags": "frazada, flannel, gris"
                            },
                            {
                                "categoria": "Frazadas",
                                "subcategoria": "Frazada Luxury Flannel",
                                "nombre": "Frazada Luxury Flannel Full/Queen - Blanco",
                                "descripcion": "Frazada Luxury Flannel, suave, cálida y elegante. Disponible en 3 tamaños y en tonos blanco, azul, brown y gris. Ideal para uso hotelero y hogar.",
                                "detalles": "Nuestra Frazada Luxury Flannel está diseñada para brindar un máximo nivel de suavidad, calidez y confort. Su textura tipo flannel de alta calidad ofrece una sensación acogedora y ligera, perfecta para complementar la cama en temporadas frescas o como pieza decorativa.\n\nDisponible en tres tamaños y en los tonos blanco, azul, brown y gris, permite adaptarse a diferentes estilos de habitación, manteniendo siempre una presentación elegante y moderna. Su material es duradero, suave al tacto y de fácil mantenimiento, garantizando una excelente experiencia de uso y larga vida útil.",
                                "color": "Blanco",
                                "marca": "Flannel",
                                "talla": "Full , Queen",
                                "tags": "frazada, flannel, blanco"
                            },
                            {
                                "categoria": "Frazadas",
                                "subcategoria": "Frazada Luxury Flannel",
                                "nombre": "Frazada Luxury Flannel King - Blanco",
                                "descripcion": "Frazada Luxury Flannel, suave, cálida y elegante. Disponible en 3 tamaños y en tonos blanco, azul, brown y gris. Ideal para uso hotelero y hogar.",
                                "detalles": "Nuestra Frazada Luxury Flannel está diseñada para brindar un máximo nivel de suavidad, calidez y confort. Su textura tipo flannel de alta calidad ofrece una sensación acogedora y ligera, perfecta para complementar la cama en temporadas frescas o como pieza decorativa.\n\nDisponible en tres tamaños y en los tonos blanco, azul, brown y gris, permite adaptarse a diferentes estilos de habitación, manteniendo siempre una presentación elegante y moderna. Su material es duradero, suave al tacto y de fácil mantenimiento, garantizando una excelente experiencia de uso y larga vida útil.",
                                "color": "Blanco",
                                "marca": "Flannel",
                                "talla": "King",
                                "tags": "frazada, flannel, blanco"
                            },
                            {
                                "categoria": "Frazadas",
                                "subcategoria": "Frazada Luxury Flannel",
                                "nombre": "Frazada Luxury Flannel Twin - Blanco",
                                "descripcion": "Frazada Luxury Flannel, suave, cálida y elegante. Disponible en 3 tamaños y en tonos blanco, azul, brown y gris. Ideal para uso hotelero y hogar.",
                                "detalles": "Nuestra Frazada Luxury Flannel está diseñada para brindar un máximo nivel de suavidad, calidez y confort. Su textura tipo flannel de alta calidad ofrece una sensación acogedora y ligera, perfecta para complementar la cama en temporadas frescas o como pieza decorativa.\n\nDisponible en tres tamaños y en los tonos blanco, azul, brown y gris, permite adaptarse a diferentes estilos de habitación, manteniendo siempre una presentación elegante y moderna. Su material es duradero, suave al tacto y de fácil mantenimiento, garantizando una excelente experiencia de uso y larga vida útil.",
                                "color": "Blanco",
                                "marca": "Flannel",
                                "talla": "Twin",
                                "tags": "frazada, flannel, blanco"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Hotelera",
                                "nombre": "Almohada Hotelera sensacion Firme - Queen",
                                "descripcion": "Almohada hotelera con tela de 300 hilos en algodón, sensación firme. Suave, fresca, resistente y de alto soporte",
                                "detalles": "Nuestra almohada hotelera con tela de 300 hilos en algodón está diseñada para ofrecer una sensación firme, excelente soporte y máximo confort al descanso del huésped. Su tela exterior de algodón de alta calidad brinda una textura suave, fresca y transpirable, ideal para uso intensivo en hoteles y proyectos institucionales.",
                                "color": "Blanco",
                                "marca": "Tela 100% algodón – 300 hilos",
                                "talla": "Queen",
                                "tags": "almohada, firme, hotel"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Hotelera",
                                "nombre": "Almohada Hotelera sensacion Firme - King",
                                "descripcion": "Almohada hotelera con tela de 300 hilos en algodón, sensación firme. Suave, fresca, resistente y de alto soporte",
                                "detalles": "Nuestra almohada hotelera con tela de 300 hilos en algodón está diseñada para ofrecer una sensación firme, excelente soporte y máximo confort al descanso del huésped. Su tela exterior de algodón de alta calidad brinda una textura suave, fresca y transpirable, ideal para uso intensivo en hoteles y proyectos institucionales.",
                                "color": "Blanco",
                                "marca": "Tela 100% algodón – 300 hilos",
                                "talla": "King",
                                "tags": "almohada, firme, hotel"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Hotelera",
                                "nombre": "Almohada Hotelera sensacion Suave Medio - Queen",
                                "descripcion": "Almohada hotelera con tela de 300 hilos en algodón, sensación suave-media. Suave, fresca y con soporte balanceado",
                                "detalles": "Nuestra almohada hotelera con tela de 300 hilos en algodón y sensación suave-media está diseñada para ofrecer un equilibrio perfecto entre suavidad y soporte, brindando un descanso cómodo y relajado al huésped. Su tela exterior de algodón de alta calidad proporciona una textura suave, fresca y altamente transpirable, ideal para uso intensivo hotelero.",
                                "color": "Blanco",
                                "marca": "Tela 100% algodón – 300 hilos",
                                "talla": "Queen",
                                "tags": "almohada, suave-media, hotel"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Hotelera",
                                "nombre": "Almohada Hotelera sensacion Suave Medio - King",
                                "descripcion": "Almohada hotelera con tela de 300 hilos en algodón, sensación suave-media. Suave, fresca y con soporte balanceado",
                                "detalles": "Nuestra almohada hotelera con tela de 300 hilos en algodón y sensación suave-media está diseñada para ofrecer un equilibrio perfecto entre suavidad y soporte, brindando un descanso cómodo y relajado al huésped. Su tela exterior de algodón de alta calidad proporciona una textura suave, fresca y altamente transpirable, ideal para uso intensivo hotelero.",
                                "color": "Blanco",
                                "marca": "Tela 100% algodón – 300 hilos",
                                "talla": "King",
                                "tags": "almohada, suave-media, hotel"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Hotelera",
                                "nombre": "Almohada Luxury Down Alternative Estandar",
                                "descripcion": "Almohada Luxury de sensación firme, alto soporte y confort.",
                                "detalles": "Nuestra Almohada Luxury de sensación firme está diseñada para ofrecer un soporte superior, confort premium y una experiencia de descanso de alto nivel. Ideal para hoteles que buscan elevar el estándar de sus habitaciones, combina firmeza, estabilidad y comodidad en un solo producto.",
                                "color": "Blanco",
                                "marca": "Tela 100% algodón – 300 hilos",
                                "talla": "Standard",
                                "tags": "almohada, luxury, firme"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Hotelera",
                                "nombre": "Almohada Luxury Down Alternative Queen",
                                "descripcion": "Almohada Luxury de sensación firme, alto soporte y confort.",
                                "detalles": "Nuestra Almohada Luxury de sensación firme está diseñada para ofrecer un soporte superior, confort premium y una experiencia de descanso de alto nivel. Ideal para hoteles que buscan elevar el estándar de sus habitaciones, combina firmeza, estabilidad y comodidad en un solo producto.",
                                "color": "Blanco",
                                "marca": "Tela 100% algodón – 300 hilos",
                                "talla": "Queen",
                                "tags": "almohada, luxury"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Hotelera",
                                "nombre": "Almohada Luxury Down Alternative King",
                                "descripcion": "Almohada Luxury de sensación firme, alto soporte y confort.",
                                "detalles": "Nuestra Almohada Luxury de sensación firme está diseñada para ofrecer un soporte superior, confort premium y una experiencia de descanso de alto nivel. Ideal para hoteles que buscan elevar el estándar de sus habitaciones, combina firmeza, estabilidad y comodidad en un solo producto.",
                                "color": "Blanco",
                                "marca": "Tela 100% algodón – 300 hilos",
                                "talla": "King",
                                "tags": "almohada, luxury"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Hotelera",
                                "nombre": "Almohada Hotelera sensacion Suave Queen",
                                "descripcion": "Almohada Luxury de sensación suave, ligera, confortable y de alto nivel.",
                                "detalles": "Nuestra Almohada Luxury de sensación suave está diseñada para brindar una experiencia de descanso ligera, confortable y envolvente, ideal para huéspedes que prefieren una sensación más delicada al dormir. Ofrece un acogido suave y adaptable, proporcionando comodidad sin ejercer presión.",
                                "color": "Blanco",
                                "marca": "Tela 100% algodón – 300 hilos",
                                "talla": "Queen",
                                "tags": "almohada, suave, hotel"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Hotelera",
                                "nombre": "Almohada Hotelera sensacion Suave King",
                                "descripcion": "Almohada Luxury de sensación suave, ligera, confortable y de alto nivel.",
                                "detalles": "Nuestra Almohada Luxury de sensación suave está diseñada para brindar una experiencia de descanso ligera, confortable y envolvente, ideal para huéspedes que prefieren una sensación más delicada al dormir. Ofrece un acogido suave y adaptable, proporcionando comodidad sin ejercer presión.",
                                "color": "Blanco",
                                "marca": "Tela 100% algodón – 300 hilos",
                                "talla": "King",
                                "tags": "almohada, suave, hotel"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Hotelera",
                                "nombre": "Almohada Hotelera mix de Pluma Estandar",
                                "descripcion": "Almohada Mix 50% pluma y 50% fibra con tela de 300 hilos en algodón. Suave, fresca y con soporte balanceado",
                                "detalles": "Nuestra almohada Mix con relleno 50% pluma y 50% fibra, confeccionada con tela de 300 hilos en algodón, ofrece una combinación ideal de suavidad natural, soporte equilibrado y confort superior. La mezcla de pluma y fibra proporciona una sensación acogedora y adaptable, manteniendo una estructura estable durante el descanso.",
                                "color": "Blanco",
                                "marca": "Tela 100% algodón 300 hilos – 50% pluma / 50% fibra",
                                "talla": "Standard",
                                "tags": "almohada, mix, pluma, fibra"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Hotelera",
                                "nombre": "Almohada Hotelera mix de Pluma Queen",
                                "descripcion": "Almohada Mix 50% pluma y 50% fibra con tela de 300 hilos en algodón. Suave, fresca y con soporte balanceado",
                                "detalles": "Nuestra almohada Mix con relleno 50% pluma y 50% fibra, confeccionada con tela de 300 hilos en algodón, ofrece una combinación ideal de suavidad natural, soporte equilibrado y confort superior. La mezcla de pluma y fibra proporciona una sensación acogedora y adaptable, manteniendo una estructura estable durante el descanso.",
                                "color": "Blanco",
                                "marca": "Tela 100% algodón 300 hilos – 50% pluma / 50% fibra",
                                "talla": "Queen",
                                "tags": "almohada, mix, pluma, fibra"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Hotelera",
                                "nombre": "Almohada Hotelera mix de Pluma King",
                                "descripcion": "Almohada Mix 50% pluma y 50% fibra con tela de 300 hilos en algodón. Suave, fresca y con soporte balanceado",
                                "detalles": "Nuestra almohada Mix con relleno 50% pluma y 50% fibra, confeccionada con tela de 300 hilos en algodón, ofrece una combinación ideal de suavidad natural, soporte equilibrado y confort superior. La mezcla de pluma y fibra proporciona una sensación acogedora y adaptable, manteniendo una estructura estable durante el descanso.",
                                "color": "Blanco",
                                "marca": "Tela 100% algodón 300 hilos – 50% pluma / 50% fibra",
                                "talla": "King",
                                "tags": "almohada, mix, pluma, fibra"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Esclusiva",
                                "nombre": "Almohada Hotelera de Fibra Micro Gel Queen",
                                "descripcion": "Almohada de fibra Micro Gel con tela de 300 hilos en algodón. Ultrasuave, fresca y adaptable",
                                "detalles": "Nuestra almohada con relleno de fibra Micro Gel y tela de 300 hilos en algodón está diseñada para ofrecer una sensación ultrasuave, excelente adaptabilidad y alto nivel de confort durante el descanso. La fibra Micro Gel proporciona una experiencia similar a la pluma, pero con mayor uniformidad.",
                                "color": "Blanco",
                                "marca": "Fibra Micro Gel - tela de 300 hilos Algodon",
                                "talla": "Queen",
                                "tags": "almohada, micro gel, hotel"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Esclusiva",
                                "nombre": "Almohada Hotelera de Fibra Micro Gel King",
                                "descripcion": "Almohada de fibra Micro Gel con tela de 300 hilos en algodón. Ultrasuave, fresca y adaptable",
                                "detalles": "Nuestra almohada con relleno de fibra Micro Gel y tela de 300 hilos en algodón está diseñada para ofrecer una sensación ultrasuave, excelente adaptabilidad y alto nivel de confort durante el descanso. La fibra Micro Gel proporciona una experiencia similar a la pluma, pero con mayor uniformidad.",
                                "color": "Blanco",
                                "marca": "Fibra Micro Gel - tela de 300 hilos Algodon",
                                "talla": "King",
                                "tags": "almohada, micro gel, hotel"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Clasica",
                                "nombre": "Almohada Premium Estandar",
                                "descripcion": "Almohada Premium línea de hogar, sensación media-suave. Cómoda, adaptable y con excelente soporte para el descanso diario.",
                                "detalles": "Nuestra almohada Premium de línea de hogar con sensación media-suave está diseñada para brindar un equilibrio perfecto entre comodidad y soporte, ideal para el descanso diario. Su estructura ofrece una acogida suave al contacto, manteniendo el soporte necesario para cabeza y cuello.",
                                "color": "Blanco",
                                "marca": "Línea hogar – sensación media-suave",
                                "talla": "Standard",
                                "tags": "almohada, premium, hogar"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Clasica",
                                "nombre": "Almohada Premium Queen",
                                "descripcion": "Almohada Premium línea de hogar, sensación media-suave. Cómoda, adaptable y con excelente soporte para el descanso diario.",
                                "detalles": "Nuestra almohada Premium de línea de hogar con sensación media-suave está diseñada para brindar un equilibrio perfecto entre comodidad y soporte, ideal para el descanso diario. Su estructura ofrece una acogida suave al contacto, manteniendo el soporte necesario para cabeza y cuello.",
                                "color": "Blanco",
                                "marca": "Línea hogar – sensación media-suave",
                                "talla": "Queen",
                                "tags": "almohada, premium, hogar"
                            },
                            {
                                "categoria": "Almohadas",
                                "subcategoria": "Linea Clasica",
                                "nombre": "Almohada Premium King",
                                "descripcion": "Almohada Premium línea de hogar, sensación media-suave. Cómoda, adaptable y con excelente soporte para el descanso diario.",
                                "detalles": "Nuestra almohada Premium de línea de hogar con sensación media-suave está diseñada para brindar un equilibrio perfecto entre comodidad y soporte, ideal para el descanso diario. Su estructura ofrece una acogida suave al contacto, manteniendo el soporte necesario para cabeza y cuello.",
                                "color": "Blanco",
                                "marca": "Línea hogar – sensación media-suave",
                                "talla": "King",
                                "tags": "almohada, premium, hogar"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas sin Fundas",
                                "nombre": "Sobrecama color Beige tamaño Twin",
                                "descripcion": "Sobrecama en color beige, suave, elegante y funcional. Disponible en tres tamaños.",
                                "detalles": "Nuestro Sobrecama en color beige está diseñado para ofrecer confort, elegancia y funcionalidad en habitaciones hoteleras. Su acabado brinda una sensación suave y ligera, ideal tanto para uso decorativo como funcional.\n\nEl tono beige aporta una imagen neutra, moderna y fácil de combinar con distintos estilos de habitación. Fabricado para uso hotelero, es resistente al uso frecuente y al lavado constante, manteniendo su forma y apariencia.\n\nDisponible en tres tamaños, adaptándose a diferentes tipos de cama y necesidades operativas.",
                                "color": "Beige",
                                "marca": "Sobrecamas sin Fundas",
                                "talla": "Twin 68x90\"",
                                "tags": "sobrecama, quilt, beige"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas sin Fundas",
                                "nombre": "Sobrecama color Beige tamaño Full/Queen",
                                "descripcion": "Sobrecama en color beige, suave, elegante y funcional. Disponible en tres tamaños.",
                                "detalles": "Nuestro Sobrecama en color beige está diseñado para ofrecer confort, elegancia y funcionalidad en habitaciones hoteleras. Su acabado brinda una sensación suave y ligera, ideal tanto para uso decorativo como funcional.\n\nEl tono beige aporta una imagen neutra, moderna y fácil de combinar con distintos estilos de habitación. Fabricado para uso hotelero, es resistente al uso frecuente y al lavado constante, manteniendo su forma y apariencia.\n\nDisponible en tres tamaños, adaptándose a diferentes tipos de cama y necesidades operativas.",
                                "color": "Beige",
                                "marca": "Sobrecamas sin Fundas",
                                "talla": "Full , Queen 90x90\"",
                                "tags": "sobrecama, quilt, beige"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas sin Fundas",
                                "nombre": "Sobrecama color Beige tamaño King",
                                "descripcion": "Sobrecama en color beige, suave, elegante y funcional. Disponible en tres tamaños.",
                                "detalles": "Nuestro Sobrecama en color beige está diseñado para ofrecer confort, elegancia y funcionalidad en habitaciones hoteleras. Su acabado brinda una sensación suave y ligera, ideal tanto para uso decorativo como funcional.\n\nEl tono beige aporta una imagen neutra, moderna y fácil de combinar con distintos estilos de habitación. Fabricado para uso hotelero, es resistente al uso frecuente y al lavado constante, manteniendo su forma y apariencia.\n\nDisponible en tres tamaños, adaptándose a diferentes tipos de cama y necesidades operativas.",
                                "color": "Beige",
                                "marca": "Sobrecamas sin Fundas",
                                "talla": "King 105x90\"",
                                "tags": "sobrecama, quilt, beige"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama Twin Blanco",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Blanco",
                                "marca": "Sobrecama con fundas",
                                "talla": "Twin 68x90\" , 20x30\"x1",
                                "tags": "sobrecama, blanco"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama Full/Queen Blanco",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Blanco",
                                "marca": "Sobrecama con fundas",
                                "talla": "Full , Queen 91x98\" , 20x30\"x2",
                                "tags": "sobrecama, blanco"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama King Blanco",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Blanco",
                                "marca": "Sobrecama con fundas",
                                "talla": "King 102x102\" , 20x40\"x2",
                                "tags": "sobrecama, blanco"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama King XL Blanco",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Blanco",
                                "marca": "Sobrecama con fundas",
                                "talla": "King XL 110x102\"",
                                "tags": "sobrecama, blanco"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama Twin Camel",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Camel",
                                "marca": "Sobrecama con fundas",
                                "talla": "Twin 68x90\" , 20x30\"x1",
                                "tags": "sobrecama, camel"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama Full/Queen Camel",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Camel",
                                "marca": "Sobrecama con fundas",
                                "talla": "Full , Queen 91x98\" , 20x30\"x2",
                                "tags": "sobrecama, camel"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama King Camel",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Camel",
                                "marca": "Sobrecama con fundas",
                                "talla": "King 102x102\" , 20x40\"x2",
                                "tags": "sobrecama, camel"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama Twin Azul",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Azul",
                                "marca": "Sobrecama con fundas",
                                "talla": "Twin 68x90'' , 20x30''x1",
                                "tags": "sobrecama, azul"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama Full/Queen Azul",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Azul",
                                "marca": "Sobrecama con fundas",
                                "talla": "Full , Queen 91x98'' , 20x30''x2",
                                "tags": "sobrecama, azul"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama King Azul",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Azul",
                                "marca": "Sobrecama con fundas",
                                "talla": "King 102x102'' , 20x40''x2",
                                "tags": "sobrecama, azul"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama Twin Gris",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Gris",
                                "marca": "Sobrecama con fundas",
                                "talla": "Twin 68x90'' , 20x30''x1",
                                "tags": "sobrecama, gris"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama Full/Queen Gris",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Gris",
                                "marca": "Sobrecama con fundas",
                                "talla": "Full , Queen 91x98'' , 20x30''x2",
                                "tags": "sobrecama, gris"
                            },
                            {
                                "categoria": "Sobrecamas",
                                "subcategoria": "Sobrecamas con Fundas",
                                "nombre": "Sobrecama King Gris",
                                "descripcion": "Sobrecama con funda decorativa incluida, ideal para uso hotelero. Disponible en 4 tamaños y 4 tonos. Elegante y funcional.",
                                "detalles": "Nuestra sobrecama con funda decorativa está diseñada para aportar elegancia, confort y una excelente presentación a las habitaciones hoteleras. Su confección ofrece una caída uniforme y un acabado decorativo sofisticado, ideal para elevar la imagen de la cama de forma rápida y funcional.\n\nDisponible en cuatro tamaños y cuatro tonos, se adapta a diferentes estilos de habitación y tipos de cama, permitiendo mantener una imagen armoniosa y profesional. Ya que es fabricada para uso hotelero, es resistente al uso frecuente y al lavado constante, conservando su forma y apariencia por más tiempo.",
                                "color": "Gris",
                                "marca": "Sobrecama con fundas",
                                "talla": "King 102x102'' , 20x40''x2",
                                "tags": "sobrecama, gris"
                            },
                            {
                                "categoria": "Protectores impermeables",
                                "subcategoria": "Protector de Almohada Impermeable con Zipper",
                                "nombre": "Protector de Almohada Impermeable Estandar/Queen",
                                "descripcion": "Nuestro protectores de almohaha almohada estan diseñado para proporcionar una barrera eficaz contra la humedad, protegiendo la almohada de derrames, líquidos y manchas",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Impermeable microfibra - Con Zipper",
                                "talla": "Estandar , Queen",
                                "tags": "protector, almohada, impermeable"
                            },
                            {
                                "categoria": "Protectores impermeables",
                                "subcategoria": "Protector de Almohada Impermeable con Zipper",
                                "nombre": "Protector de Almohada Impermeable King",
                                "descripcion": "Nuestro protectores de almohaha almohada estan diseñado para proporcionar una barrera eficaz contra la humedad, protegiendo la almohada de derrames, líquidos y manchas",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Impermeable microfibra - Con Zipper",
                                "talla": "King",
                                "tags": "protector, almohada, impermeable"
                            },
                            {
                                "categoria": "Protectores impermeables",
                                "subcategoria": "Protector de Colchón Impermeable Acolchado",
                                "nombre": "Protector De Colchon Acolchonado Impermeable Twin",
                                "descripcion": "Estan diseñado para proteger el colchón de manchas, derrames, sudor y líquidos, al tiempo que brinda una capa adicional de comodidad. Está confeccionado con tela de microfibra suave y transpirables que ofrecen una sensación agradable al tacto.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Protector de Colchón Impermeable Acolchado",
                                "talla": "Twin",
                                "tags": "protector, colchón, impermeable"
                            },
                            {
                                "categoria": "Protectores impermeables",
                                "subcategoria": "Protector de Colchón Impermeable Acolchado",
                                "nombre": "Protector De Colchon Acolchonado Impermeable Full",
                                "descripcion": "Estan diseñado para proteger el colchón de manchas, derrames, sudor y líquidos, al tiempo que brinda una capa adicional de comodidad. Está confeccionado con tela de microfibra suave y transpirables que ofrecen una sensación agradable al tacto.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Protector de Colchón Impermeable Acolchado",
                                "talla": "Full",
                                "tags": "protector, colchón, impermeable"
                            },
                            {
                                "categoria": "Protectores impermeables",
                                "subcategoria": "Protector de Colchón Impermeable Acolchado",
                                "nombre": "Protector De Colchon Acolchonado Impermeable Queen",
                                "descripcion": "Estan diseñado para proteger el colchón de manchas, derrames, sudor y líquidos, al tiempo que brinda una capa adicional de comodidad. Está confeccionado con tela de microfibra suave y transpirables que ofrecen una sensación agradable al tacto.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Protector de Colchón Impermeable Acolchado",
                                "talla": "Queen",
                                "tags": "protector, colchón, impermeable"
                            },
                            {
                                "categoria": "Protectores impermeables",
                                "subcategoria": "Protector de Colchón Impermeable Acolchado",
                                "nombre": "Protector De Colchon Acolchonado Impermeable King",
                                "descripcion": "Estan diseñado para proteger el colchón de manchas, derrames, sudor y líquidos, al tiempo que brinda una capa adicional de comodidad. Está confeccionado con tela de microfibra suave y transpirables que ofrecen una sensación agradable al tacto.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Protector de Colchón Impermeable Acolchado",
                                "talla": "King",
                                "tags": "protector, colchón, impermeable"
                            },
                            {
                                "categoria": "Protectores impermeables",
                                "subcategoria": "Protector de Colchón Impermeable Sencillo",
                                "nombre": "Protector de Colchon Deluxe Impermeable Twin",
                                "descripcion": "Está diseñado para proteger el colchón de derrames, manchas y líquidos, proporcionando una barrera efectiva contra la humedad. Está fabricado con materiales resistentes al agua que evitan la penetración de líquidos, preservando la limpieza y la integridad del colchón.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Protector de Colchón Impermeable Deluxe",
                                "talla": "Twin",
                                "tags": "protector, colchón, deluxe"
                            },
                            {
                                "categoria": "Protectores impermeables",
                                "subcategoria": "Protector de Colchón Impermeable Sencillo",
                                "nombre": "Protector de Colchon Deluxe Impermeable Full",
                                "descripcion": "Está diseñado para proteger el colchón de derrames, manchas y líquidos, proporcionando una barrera efectiva contra la humedad. Está fabricado con materiales resistentes al agua que evitan la penetración de líquidos, preservando la limpieza y la integridad del colchón.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Protector de Colchón Impermeable Deluxe",
                                "talla": "Full",
                                "tags": "protector, colchón, deluxe"
                            },
                            {
                                "categoria": "Protectores impermeables",
                                "subcategoria": "Protector de Colchón Impermeable Sencillo",
                                "nombre": "Protector de Colchon Deluxe Impermeable Queen",
                                "descripcion": "Está diseñado para proteger el colchón de derrames, manchas y líquidos, proporcionando una barrera efectiva contra la humedad. Está fabricado con materiales resistentes al agua que evitan la penetración de líquidos, preservando la limpieza y la integridad del colchón.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Protector de Colchón Impermeable Deluxe",
                                "talla": "Queen",
                                "tags": "protector, colchón, deluxe"
                            },
                            {
                                "categoria": "Protectores impermeables",
                                "subcategoria": "Protector de Colchón Impermeable Sencillo",
                                "nombre": "Protector de Colchon Deluxe Impermeable King",
                                "descripcion": "Está diseñado para proteger el colchón de derrames, manchas y líquidos, proporcionando una barrera efectiva contra la humedad. Está fabricado con materiales resistentes al agua que evitan la penetración de líquidos, preservando la limpieza y la integridad del colchón.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Protector de Colchón Impermeable Deluxe",
                                "talla": "King",
                                "tags": "protector, colchón, deluxe"
                            },
                            {
                                "categoria": "Topper",
                                "subcategoria": "Topper para Colchon 2\" de grosor",
                                "nombre": "Topper para colchon de tamaño Twin",
                                "descripcion": "Topper de 2” de grosor con 4 ligas de anclaje. Aporta mayor confort y ajuste seguro al colchón. Disponible en 4 tamaños.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Topper para Colchon con ligas de anclaje",
                                "talla": "Twin",
                                "tags": "topper, colchón"
                            },
                            {
                                "categoria": "Topper",
                                "subcategoria": "Topper para Colchon 2\" de grosor",
                                "nombre": "Topper para colchon de tamaño Full",
                                "descripcion": "Topper de 2” de grosor con 4 ligas de anclaje. Aporta mayor confort y ajuste seguro al colchón. Disponible en 4 tamaños.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Topper para Colchon con ligas de anclaje",
                                "talla": "Full",
                                "tags": "topper, colchón"
                            },
                            {
                                "categoria": "Topper",
                                "subcategoria": "Topper para Colchon 2\" de grosor",
                                "nombre": "Topper para colchon de tamaño Queen",
                                "descripcion": "Topper de 2” de grosor con 4 ligas de anclaje. Aporta mayor confort y ajuste seguro al colchón. Disponible en 4 tamaños.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Topper para Colchon con ligas de anclaje",
                                "talla": "Queen",
                                "tags": "topper, colchón"
                            },
                            {
                                "categoria": "Topper",
                                "subcategoria": "Topper para Colchon 2\" de grosor",
                                "nombre": "Topper para colchon de tamaño King",
                                "descripcion": "Topper de 2” de grosor con 4 ligas de anclaje. Aporta mayor confort y ajuste seguro al colchón. Disponible en 4 tamaños.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Topper para Colchon con ligas de anclaje",
                                "talla": "King",
                                "tags": "topper, colchón"
                            },
                            {
                                "categoria": "Servilletas",
                                "subcategoria": "Servilleta Tela Spun – Flament",
                                "nombre": "Servilletas 20x20\" Tela Spun - Flament - White Color",
                                "descripcion": "Servilletas 20x20” en tela Spun – Flament. Resistentes, absorbentes y con excelente presentación. Ideales para uso hotelero y eventos.",
                                "detalles": "Nuestras servilletas de 20 x 20 pulgadas en tela Spun – Flament están diseñadas para ofrecer una excelente combinación de resistencia, presentación y practicidad en entornos de alto tráfico como hoteles, restaurantes, banquetes y eventos.\n\nSu fabricación en tela Spun garantiza una textura tipo tela, mayor durabilidad y buena absorción, manteniendo una apariencia elegante durante el servicio. Son ideales para uso institucional y hotelero, ya que ofrecen una imagen limpia y profesional en cada montaje de mesa.",
                                "color": "Blanco",
                                "marca": "Tela Spun – Flament",
                                "talla": "20x20\"",
                                "tags": "servilleta, spun, hotel"
                            },
                            {
                                "categoria": "Servilletas",
                                "subcategoria": "Servilleta Tela Spun – Flament",
                                "nombre": "Servilletas 20x20\" Tela Spun - Flament - Black Color",
                                "descripcion": "Servilletas 20x20” en tela Spun – Flament. Resistentes, absorbentes y con excelente presentación. Ideales para uso hotelero y eventos.",
                                "detalles": "Nuestras servilletas de 20 x 20 pulgadas en tela Spun – Flament están diseñadas para ofrecer una excelente combinación de resistencia, presentación y practicidad en entornos de alto tráfico como hoteles, restaurantes, banquetes y eventos.\n\nSu fabricación en tela Spun garantiza una textura tipo tela, mayor durabilidad y buena absorción, manteniendo una apariencia elegante durante el servicio. Son ideales para uso institucional y hotelero, ya que ofrecen una imagen limpia y profesional en cada montaje de mesa.",
                                "color": "Negro",
                                "marca": "Tela Spun – Flament",
                                "talla": "20x20\"",
                                "tags": "servilleta, spun, hotel"
                            },
                            {
                                "categoria": "Batas y Pantuflas",
                                "subcategoria": "Batas Terry Velour",
                                "nombre": "Batas, 100% Algodon Terry Velour - Cream Color S-M",
                                "descripcion": "Batas 100% hoteleras, suaves, cómodas y resistentes. Disponibles en 3 tonos y 2 tamaños. Ideales para hoteles y spa.",
                                "detalles": "Nuestras batas 100% hoteleras están diseñadas para brindar máximo confort, suavidad y una presentación elegante al huésped. Confeccionadas con materiales de alta calidad para uso intensivo, ofrecen una sensación agradable al contacto con la piel, excelente absorción y gran durabilidad frente a lavados frecuentes.\n\nDisponibles en tres tonos y dos tamaños, se adaptan a distintos estilos de habitación y necesidades operativas, manteniendo siempre una imagen ordenada y profesional en hoteles, resorts, spas y proyectos institucionales.",
                                "color": "Cream",
                                "marca": "100% Cotton Terry Velour",
                                "talla": "S , M",
                                "tags": "bata, hotel, algodón"
                            },
                            {
                                "categoria": "Batas y Pantuflas",
                                "subcategoria": "Batas Terry Velour",
                                "nombre": "Batas, 100% Algodon Terry Velour - Light Pink Color S-M",
                                "descripcion": "Batas 100% hoteleras, suaves, cómodas y resistentes. Disponibles en 3 tonos y 2 tamaños. Ideales para hoteles y spa.",
                                "detalles": "Nuestras batas 100% hoteleras están diseñadas para brindar máximo confort, suavidad y una presentación elegante al huésped. Confeccionadas con materiales de alta calidad para uso intensivo, ofrecen una sensación agradable al contacto con la piel, excelente absorción y gran durabilidad frente a lavados frecuentes.\n\nDisponibles en tres tonos y dos tamaños, se adaptan a distintos estilos de habitación y necesidades operativas, manteniendo siempre una imagen ordenada y profesional en hoteles, resorts, spas y proyectos institucionales.",
                                "color": "Light Pink",
                                "marca": "100% Cotton Terry Velour",
                                "talla": "S , M",
                                "tags": "bata, hotel, algodón"
                            },
                            {
                                "categoria": "Batas y Pantuflas",
                                "subcategoria": "Batas Terry Velour",
                                "nombre": "Batas, 100% Algodon Terry Velour - White Color S-M",
                                "descripcion": "Batas 100% hoteleras, suaves, cómodas y resistentes. Disponibles en 3 tonos y 2 tamaños. Ideales para hoteles y spa.",
                                "detalles": "Nuestras batas 100% hoteleras están diseñadas para brindar máximo confort, suavidad y una presentación elegante al huésped. Confeccionadas con materiales de alta calidad para uso intensivo, ofrecen una sensación agradable al contacto con la piel, excelente absorción y gran durabilidad frente a lavados frecuentes.\n\nDisponibles en tres tonos y dos tamaños, se adaptan a distintos estilos de habitación y necesidades operativas, manteniendo siempre una imagen ordenada y profesional en hoteles, resorts, spas y proyectos institucionales.",
                                "color": "Blanco",
                                "marca": "100% Cotton Terry Velour",
                                "talla": "S , M",
                                "tags": "bata, hotel, algodón"
                            },
                            {
                                "categoria": "Batas y Pantuflas",
                                "subcategoria": "Batas Terry Velour",
                                "nombre": "Batas, 100% Algodon Terry Velour - White Color L-XL",
                                "descripcion": "Batas 100% hoteleras, suaves, cómodas y resistentes. Disponibles en 3 tonos y 2 tamaños. Ideales para hoteles y spa.",
                                "detalles": "Nuestras batas 100% hoteleras están diseñadas para brindar máximo confort, suavidad y una presentación elegante al huésped. Confeccionadas con materiales de alta calidad para uso intensivo, ofrecen una sensación agradable al contacto con la piel, excelente absorción y gran durabilidad frente a lavados frecuentes.\n\nDisponibles en tres tonos y dos tamaños, se adaptan a distintos estilos de habitación y necesidades operativas, manteniendo siempre una imagen ordenada y profesional en hoteles, resorts, spas y proyectos institucionales.",
                                "color": "Blanco",
                                "marca": "100% Cotton Terry Velour",
                                "talla": "L , XL",
                                "tags": "bata, hotel, algodón"
                            },
                            {
                                "categoria": "Batas y Pantuflas",
                                "subcategoria": "Pantuflas Terry Velour",
                                "nombre": "Pantuflas, 100% Poly Terry Velour – Pantufla",
                                "descripcion": "Pantuflas (Slippers) 100% Poly Terry Velour, suaves, cómodas y ligeras. Ideales para uso hotelero y zonas de descanso.",
                                "detalles": "Nuestras pantuflas hoteleras en 100% Poly Terry Velour están diseñadas para ofrecer suavidad, confort y una excelente presentación al huésped. Su textura tipo velour proporciona una sensación agradable al tacto, ideal para uso en habitaciones, spa y áreas de descanso.",
                                "color": "Blanco",
                                "marca": "100% Poly Terry Velour",
                                "talla": "Única",
                                "tags": "pantuflas, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Platinum",
                                "nombre": "Toalla de mano 16 x 30\" 650gsm",
                                "descripcion": "Toalla de mano 100% hotelera, 100% algodón con doble costura. Alta absorción, suave y resistente.",
                                "detalles": "Nuestra toalla de mano 100% hotelera está confeccionada en 100% algodón, ofreciendo una excelente capacidad de absorción, suavidad al tacto y alta resistencia para uso intensivo. Su doble costura reforzada garantiza mayor durabilidad y un acabado profesional, ideal para hoteles, spas, hospitales y proyectos institucionales.",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "16 x 30\" 650gsm",
                                "tags": "toalla, mano, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Platinum",
                                "nombre": "Toalla de Cuerpo tamaño 27 x 54\" 650gsm",
                                "descripcion": "Toallas de cuerpo 100% hoteleras, 100% algodón con doble costura. Suaves, absorbentes y resistentes. Disponibles en dos tamaños.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "27 x 54\" 650gsm",
                                "tags": "toalla, cuerpo, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Platinum",
                                "nombre": "Toalla de Cuerpo 30 x 60\" 650gsm",
                                "descripcion": "Toallas de cuerpo 100% hoteleras, 100% algodón con doble costura. Suaves, absorbentes y resistentes. Disponibles en dos tamaños.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "30 x 60\" 650gsm",
                                "tags": "toalla, cuerpo, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Silver",
                                "nombre": "Toalla De Cara 12x12\" 50g",
                                "descripcion": "Toallas de cara 100% hoteleras, 100% algodón con doble costura. Alta absorción, suavidad y gran durabilidad. Disponibles en dos tamaños y dos tonos.",
                                "detalles": "Nuestras toallas de cara 100% hoteleras están fabricadas en 100% algodón, garantizando alta absorción, suavidad al tacto y excelente durabilidad para uso intensivo. Su doble costura reforzada aporta mayor resistencia y un acabado profesional, ideal para hoteles, spas y proyectos institucionales.\n\nDiseñadas para conservar su volumen, textura y rendimiento tras múltiples lavados, están disponibles en dos tamaños y en dos tonos, adaptándose a distintas necesidades de presentación y operación.\n\nUna opción confiable para quienes buscan calidad hotelera, resistencia y confort en cada uso.",
                                "color": "Negro",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "12x12\" 50g",
                                "tags": "toalla, cara, hotel, negro"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Silver",
                                "nombre": "Toallas de Cara 12x12\" 40g",
                                "descripcion": "Toallas de cara 100% hoteleras, 100% algodón con doble costura. Alta absorción, suavidad y gran durabilidad. Disponibles en dos tamaños y dos tonos.",
                                "detalles": "Nuestras toallas de cara 100% hoteleras están fabricadas en 100% algodón, garantizando alta absorción, suavidad al tacto y excelente durabilidad para uso intensivo. Su doble costura reforzada aporta mayor resistencia y un acabado profesional, ideal para hoteles, spas y proyectos institucionales.\n\nDiseñadas para conservar su volumen, textura y rendimiento tras múltiples lavados, están disponibles en dos tamaños y en dos tonos, adaptándose a distintas necesidades de presentación y operación.\n\nUna opción confiable para quienes buscan calidad hotelera, resistencia y confort en cada uso.",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "12x12\" 40g",
                                "tags": "toalla, cara, hotel, blanco"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Silver",
                                "nombre": "Toalla de mano 15 X 28\" 147g",
                                "descripcion": "Toalla de mano 100% hotelera, 100% algodón con doble costura. Alta absorción, suave y resistente.",
                                "detalles": "Nuestra toalla de mano 100% hotelera está confeccionada en 100% algodón, ofreciendo una excelente capacidad de absorción, suavidad al tacto y alta resistencia para uso intensivo. Su doble costura reforzada garantiza mayor durabilidad y un acabado profesional, ideal para hoteles, spas, hospitales y proyectos institucionales.",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "15 X 28\" 147g",
                                "tags": "toalla, mano, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Silver",
                                "nombre": "Toalla de Cuerpo 27 x 50\" 472g",
                                "descripcion": "Toallas de cuerpo 100% hoteleras, 100% algodón con doble costura. Suaves, absorbentes y resistentes. Disponibles en dos tamaños.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "27 x 50\" 472g",
                                "tags": "toalla, cuerpo, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Silver",
                                "nombre": "Bath Towel. 27 x 54\" 508g",
                                "descripcion": "Toallas de cuerpo 100% hoteleras, 100% algodón con doble costura. Suaves, absorbentes y resistentes. Disponibles en dos tamaños.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "27 x 54\" 508g",
                                "tags": "toalla, cuerpo, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Silver",
                                "nombre": "Toalla de piso 20x26\" 260g",
                                "descripcion": "Toalla de piso 100% hotelera, 100% algodón con doble costura. Alta absorción, resistente y segura. Disponible en dos tamaños.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "20x26\" 260g",
                                "tags": "toalla, piso, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Gold",
                                "nombre": "Toalla De Cara 13x13\" 57g",
                                "descripcion": "Toallas de cara 100% hoteleras, 100% algodón con doble costura. Alta absorción, suavidad y gran durabilidad.",
                                "detalles": "Nuestras toallas de cara 100% hoteleras están fabricadas en 100% algodón, garantizando alta absorción, suavidad al tacto y excelente durabilidad para uso intensivo. Su doble costura reforzada aporta mayor resistencia y un acabado profesional, ideal para hoteles, spas y proyectos institucionales.",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "13x13\" 57g",
                                "tags": "toalla, cara, hotel, blanco"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Gold",
                                "nombre": "Toalla De Mano 16x30\" 170g",
                                "descripcion": "Toalla de mano 100% hotelera, 100% algodón con doble costura. Alta absorción, suave y resistente.",
                                "detalles": "Nuestra toalla de mano 100% hotelera está confeccionada en 100% algodón, ofreciendo una excelente capacidad de absorción, suavidad al tacto y alta resistencia para uso intensivo. Su doble costura reforzada garantiza mayor durabilidad y un acabado profesional, ideal para hoteles, spas, hospitales y proyectos institucionales.\n\nDiseñada para conservar su textura y rendimiento tras múltiples lavados, esta toalla es una opción práctica, funcional y confiable para operaciones de alta rotación. Disponible en un solo tamaño, optimizando estandarización y control de inventario.",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "16x30\" 170g",
                                "tags": "toalla, mano, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Gold",
                                "nombre": "Toalla de piso 20x30\" 310g",
                                "descripcion": "Toalla de piso 100% hotelera, 100% algodón con doble costura. Alta absorción, resistente y segura. Disponible en dos tamaños.",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "20x30\" 310g",
                                "tags": "toalla, piso, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Gold",
                                "nombre": "Toalla De Cuerpo 27x50\" 500g",
                                "descripcion": "Toallas de cuerpo 100% hoteleras, 100% algodón con doble costura. Suaves, absorbentes y resistentes. Disponibles en tres tamaños.",
                                "detalles": "Nuestras toallas de cuerpo 100% hoteleras están elaboradas en 100% algodón, brindando una excelente absorción, suavidad superior y alta resistencia para uso intensivo en hoteles, spas y proyectos institucionales. Su doble costura reforzada asegura mayor durabilidad y un acabado profesional incluso bajo lavados frecuentes.\n\nDiseñadas para ofrecer máximo confort al huésped y eficiencia operativa, conservan su textura, volumen y rendimiento a lo largo del tiempo. Disponibles en tres tamaños, se adaptan a distintos tipos de habitación y requerimientos de servicio.",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "27x50\" 500g",
                                "tags": "toalla, cuerpo, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Gold",
                                "nombre": "Toalla De Cuerpo 27x54\" 580g",
                                "descripcion": "Toallas de cuerpo 100% hoteleras, 100% algodón con doble costura. Suaves, absorbentes y resistentes. Disponibles en tres tamaños.",
                                "detalles": "Nuestras toallas de cuerpo 100% hoteleras están elaboradas en 100% algodón, brindando una excelente absorción, suavidad superior y alta resistencia para uso intensivo en hoteles, spas y proyectos institucionales. Su doble costura reforzada asegura mayor durabilidad y un acabado profesional incluso bajo lavados frecuentes.\n\nDiseñadas para ofrecer máximo confort al huésped y eficiencia operativa, conservan su textura, volumen y rendimiento a lo largo del tiempo. Disponibles en tres tamaños, se adaptan a distintos tipos de habitación y requerimientos de servicio.",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "27x54\" 580g",
                                "tags": "toalla, cuerpo, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Linea Gold",
                                "nombre": "Toalla de Cuerpo 30x60\" 690g",
                                "descripcion": "Toallas de cuerpo 100% hoteleras, 100% algodón con doble costura. Suaves, absorbentes y resistentes. Disponibles en tres tamaños.",
                                "detalles": "Nuestras toallas de cuerpo 100% hoteleras están elaboradas en 100% algodón, brindando una excelente absorción, suavidad superior y alta resistencia para uso intensivo en hoteles, spas y proyectos institucionales. Su doble costura reforzada asegura mayor durabilidad y un acabado profesional incluso bajo lavados frecuentes.\n\nDiseñadas para ofrecer máximo confort al huésped y eficiencia operativa, conservan su textura, volumen y rendimiento a lo largo del tiempo. Disponibles en tres tamaños, se adaptan a distintos tipos de habitación y requerimientos de servicio.",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "30x60\" 690g",
                                "tags": "toalla, cuerpo, hotel"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Toallas de Piscina",
                                "nombre": "Toalla de piscina 35x70\" 570g",
                                "descripcion": "Toallas de piscina 100% hoteleras, 100% algodón con doble costura. Alta absorción, suaves y resistentes. Disponibles en dos tamaños y dos tonos.",
                                "detalles": "Nuestras toallas de piscina 100% hoteleras están confeccionadas en 100% algodón, ofreciendo alta absorción, suavidad al tacto y gran resistencia para uso intensivo en áreas de piscina, playa, spa y recreación. Su doble costura reforzada garantiza mayor durabilidad frente a la humedad constante y los lavados frecuentes.",
                                "color": "Sand Brown",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "35x70\" 570g",
                                "tags": "toalla, piscina, arena"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Toallas de Piscina",
                                "nombre": "Toalla de Piscina Azul 35x70\" 570g",
                                "descripcion": "Toallas de piscina 100% hoteleras, 100% algodón con doble costura. Alta absorción, suaves y resistentes. Disponibles en dos tamaños y dos tonos.",
                                "detalles": "Nuestras toallas de piscina 100% hoteleras están confeccionadas en 100% algodón, ofreciendo alta absorción, suavidad al tacto y gran resistencia para uso intensivo en áreas de piscina, playa, spa y recreación. Su doble costura reforzada garantiza mayor durabilidad frente a la humedad constante y los lavados frecuentes.",
                                "color": "Azul",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "35x70\" 570g",
                                "tags": "toalla, piscina, azul"
                            },
                            {
                                "categoria": "Toallas",
                                "subcategoria": "Toallas de Piscina",
                                "nombre": "Pool Chair Cover with 17\" flap",
                                "descripcion": "Pool chair cover de 17” en 100% algodón, suave, absorbente y resistente. Ideal para uso hotelero en áreas de piscina.",
                                "detalles": "Nuestro Pool Cover Chair de 17” en 100% algodón está diseñado para áreas de piscina y descanso, ofreciendo máxima absorción, confort y una presentación impecable sobre las tumbonas o sillas de piscina. Su confección en algodón garantiza suavidad al contacto con la piel y alta resistencia al uso intensivo.",
                                "color": "Blanco",
                                "marca": "Toallas 100% algodón - Doble Costura",
                                "talla": "17\" flap",
                                "tags": "pool chair cover, hotel"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Duvet Cover",
                                "nombre": "Duvet Cover de 300 hilos - Twin",
                                "descripcion": "Duvet cover hotelero de 300 hilos en sateen 100% algodón, extra suave y elegante. Color blanco. Disponible en tamaños Twin, Full, Queen y King.",
                                "detalles": "Nuestro duvet cover hotelero de 300 hilos en sateen 100% algodón está diseñado para ofrecer una experiencia de descanso superior en suavidad y elegancia, ideal para hoteles que buscan elevar el estándar de confort de sus habitaciones.",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "Twin 66–68x86\"",
                                "tags": "duvet cover, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Duvet Cover",
                                "nombre": "Duvet Cover de 300 hilos - Full",
                                "descripcion": "Duvet cover hotelero de 300 hilos en sateen 100% algodón, extra suave y elegante. Color blanco. Disponible en tamaños Twin, Full, Queen y King.",
                                "detalles": "Nuestro duvet cover hotelero de 300 hilos en sateen 100% algodón está diseñado para ofrecer una experiencia de descanso superior en suavidad y elegancia, ideal para hoteles que buscan elevar el estándar de confort de sus habitaciones.",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "Full 88x90\"–83x91\"",
                                "tags": "duvet cover, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Duvet Cover",
                                "nombre": "Duvet Cover de 300 hilos - Queen",
                                "descripcion": "Duvet cover hotelero de 300 hilos en sateen 100% algodón, extra suave y elegante. Color blanco. Disponible en tamaños Twin, Full, Queen y King.",
                                "detalles": "Nuestro duvet cover hotelero de 300 hilos en sateen 100% algodón está diseñado para ofrecer una experiencia de descanso superior en suavidad y elegancia, ideal para hoteles que buscan elevar el estándar de confort de sus habitaciones.",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "Queen 93x98\"",
                                "tags": "duvet cover, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Duvet Cover",
                                "nombre": "Duvet Cover de 300 hilos - King",
                                "descripcion": "Duvet cover hotelero de 300 hilos en sateen 100% algodón, extra suave y elegante. Color blanco. Disponible en tamaños Twin, Full, Queen y King.",
                                "detalles": "Nuestro duvet cover hotelero de 300 hilos en sateen 100% algodón está diseñado para ofrecer una experiencia de descanso superior en suavidad y elegancia, ideal para hoteles que buscan elevar el estándar de confort de sus habitaciones.",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "King 105x90\"–106x91\"",
                                "tags": "duvet cover, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Sábana Encimera",
                                "nombre": "Sabanas Encimera de 300 hilos - Twin",
                                "descripcion": "Linea de 300 hilos en 100% algodón sateen, extra suave, fresca y elegante. Color blanco, ideal para uso hotelero premium. Disponible en sábana flat, ajustable y fundas.",
                                "detalles": "Nuestra sábana y fundas hotelera de 300 hilos en 100% algodón sateen ofrece un nivel superior de suavidad, elegancia y confort, diseñada para proyectos hoteleros que buscan una experiencia de alto nivel de descanso para sus huéspedes.\n\nEl tejido sateen de 300 hilos se caracteriza por su acabado sedoso, tacto ultra suave y ligero brillo natural, aportando una sensación de lujo y sofisticación a cada habitación. Al ser 100% algodón, garantiza alta transpirabilidad, frescura y máximo confort térmico, ideal para climas cálidos y uso prolongado.",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "Twin 66x120\"",
                                "tags": "flat sheet, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Sábana Encimera",
                                "nombre": "Sabanas Encimera de 300 hilos - Full",
                                "descripcion": "Linea de 300 hilos en 100% algodón sateen, extra suave, fresca y elegante. Color blanco, ideal para uso hotelero premium. Disponible en sábana flat, ajustable y fundas.",
                                "detalles": "Nuestra sábana y fundas hotelera de 300 hilos en 100% algodón sateen ofrece un nivel superior de suavidad, elegancia y confort, diseñada para proyectos hoteleros que buscan una experiencia de alto nivel de descanso para sus huéspedes.\n\nEl tejido sateen de 300 hilos se caracteriza por su acabado sedoso, tacto ultra suave y ligero brillo natural, aportando una sensación de lujo y sofisticación a cada habitación. Al ser 100% algodón, garantiza alta transpirabilidad, frescura y máximo confort térmico, ideal para climas cálidos y uso prolongado.",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "Full 84x120\"",
                                "tags": "flat sheet, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Sábana Encimera",
                                "nombre": "Sabanas Encimera de 300 hilos - Queen",
                                "descripcion": "Linea de 300 hilos en 100% algodón sateen, extra suave, fresca y elegante. Color blanco, ideal para uso hotelero premium. Disponible en sábana flat, ajustable y fundas.",
                                "detalles": "Nuestra sábana y fundas hotelera de 300 hilos en 100% algodón sateen ofrece un nivel superior de suavidad, elegancia y confort, diseñada para proyectos hoteleros que buscan una experiencia de alto nivel de descanso para sus huéspedes.\n\nEl tejido sateen de 300 hilos se caracteriza por su acabado sedoso, tacto ultra suave y ligero brillo natural, aportando una sensación de lujo y sofisticación a cada habitación. Al ser 100% algodón, garantiza alta transpirabilidad, frescura y máximo confort térmico, ideal para climas cálidos y uso prolongado.",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "Queen 98x120\"",
                                "tags": "flat sheet, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Sábana Encimera",
                                "nombre": "Sabanas Encimera de 300 hilos - King",
                                "descripcion": "Linea de 300 hilos en 100% algodón sateen, extra suave, fresca y elegante. Color blanco, ideal para uso hotelero premium. Disponible en sábana flat, ajustable y fundas.",
                                "detalles": "Nuestra sábana y fundas hotelera de 300 hilos en 100% algodón sateen ofrece un nivel superior de suavidad, elegancia y confort, diseñada para proyectos hoteleros que buscan una experiencia de alto nivel de descanso para sus huéspedes.\n\nEl tejido sateen de 300 hilos se caracteriza por su acabado sedoso, tacto ultra suave y ligero brillo natural, aportando una sensación de lujo y sofisticación a cada habitación. Al ser 100% algodón, garantiza alta transpirabilidad, frescura y máximo confort térmico, ideal para climas cálidos y uso prolongado.",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "King 118x120\"",
                                "tags": "flat sheet, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Sábana Ajustable",
                                "nombre": "Sabanas ajustable de 300 Hilos - Twin",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "Twin 39x80+14\"",
                                "tags": "fitted sheet, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Sábana Ajustable",
                                "nombre": "Sabanas ajustable de 300 Hilos - Full",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "Full 54x80+14\"",
                                "tags": "fitted sheet, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Sábana Ajustable",
                                "nombre": "Sabanas ajustable de 300 Hilos - Queen",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "Queen 60x80+14\"",
                                "tags": "fitted sheet, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Sábana Ajustable",
                                "nombre": "Sabanas ajustable de 300 Hilos - King",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "King 78x80+14\"",
                                "tags": "fitted sheet, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Funda de Almohada",
                                "nombre": "Fundas de Almohada 300 hilos - Queen",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "Queen 21x34\"",
                                "tags": "pillowcase, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 300 Hilos Algodon",
                                "subcategoria": "Funda de Almohada",
                                "nombre": "Fundas de Almohada 300 hilos - King",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "300 hilos - 100% Algodon - Sateen",
                                "talla": "King 21x41\"",
                                "tags": "pillowcase, 300 hilos, sateen"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Rayas satinadas",
                                "nombre": "Duvet Cover Stripe 10mm - Full",
                                "descripcion": "Duvet cover T250 en sateen blanco con diseño Stripe de 10 mm, composición 60% algodón y 40% poliéster. Suave, elegante y resistente",
                                "detalles": "Nuestro Duvet Cover T250 en tela sateen con diseño de rayas de 10 mm, elaborado con composición 60% algodón y 40% poliéster, ofrece un balance ideal entre suavidad, elegancia y alta resistencia, cumpliendo con los estándares del sector hotelero.\n\nEl sateen de 250 hilos (T250) proporciona un tacto sedoso, mayor suavidad y un sutil brillo natural, mientras que su diseño de franjas de 10 mm aporta una apariencia clásica, limpia y sofisticada, ampliamente utilizada en hoteles de categoría superior.",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Sateen - Stripe 10mm",
                                "talla": "Full 88x90\"–83x91\"",
                                "tags": "duvet cover, 250 hilos, sateen, stripe"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Rayas satinadas",
                                "nombre": "Duvet Cover Stripe 10mm - Queen",
                                "descripcion": "Duvet cover T250 en sateen blanco con diseño Stripe de 10 mm, composición 60% algodón y 40% poliéster. Suave, elegante y resistente",
                                "detalles": "Nuestro Duvet Cover T250 en tela sateen con diseño de rayas de 10 mm, elaborado con composición 60% algodón y 40% poliéster, ofrece un balance ideal entre suavidad, elegancia y alta resistencia, cumpliendo con los estándares del sector hotelero.\n\nEl sateen de 250 hilos (T250) proporciona un tacto sedoso, mayor suavidad y un sutil brillo natural, mientras que su diseño de franjas de 10 mm aporta una apariencia clásica, limpia y sofisticada, ampliamente utilizada en hoteles de categoría superior.",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Sateen - Stripe 10mm",
                                "talla": "Queen 93x98\"–91x91\"",
                                "tags": "duvet cover, 250 hilos, sateen, stripe"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Rayas satinadas",
                                "nombre": "Duvet Cover Stripe 10mm - King",
                                "descripcion": "Duvet cover T250 en sateen blanco con diseño Stripe de 10 mm, composición 60% algodón y 40% poliéster. Suave, elegante y resistente",
                                "detalles": "Nuestro Duvet Cover T250 en tela sateen con diseño de rayas de 10 mm, elaborado con composición 60% algodón y 40% poliéster, ofrece un balance ideal entre suavidad, elegancia y alta resistencia, cumpliendo con los estándares del sector hotelero.\n\nEl sateen de 250 hilos (T250) proporciona un tacto sedoso, mayor suavidad y un sutil brillo natural, mientras que su diseño de franjas de 10 mm aporta una apariencia clásica, limpia y sofisticada, ampliamente utilizada en hoteles de categoría superior.",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Sateen - Stripe 10mm",
                                "talla": "King 105x90\"–106x91\"",
                                "tags": "duvet cover, 250 hilos, sateen, stripe"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Duvet Cover de 250 hilos - Twin",
                                "descripcion": "Duvet cover hotelero de 250 hilos en percale blanco, composición 60% algodón y 40% poliéster. Suave, fresco y resistente. Disponible en tamaños Twin, Full, Queen y King.",
                                "detalles": "Nuestro duvet cover hotelero de 250 hilos en percale blanco está confeccionado con una equilibrada composición de 60% algodón y 40% poliéster, diseñada para ofrecer máximo confort, frescura y alta durabilidad en entornos de uso intensivo como hoteles, resorts y alojamientos institucionales.",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Twin 69x89\"",
                                "tags": "duvet cover, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Duvet Cover de 250 hilos - Full",
                                "descripcion": "Duvet cover hotelero de 250 hilos en percale blanco, composición 60% algodón y 40% poliéster. Suave, fresco y resistente. Disponible en tamaños Twin, Full, Queen y King.",
                                "detalles": "Nuestro duvet cover hotelero de 250 hilos en percale blanco está confeccionado con una equilibrada composición de 60% algodón y 40% poliéster, diseñada para ofrecer máximo confort, frescura y alta durabilidad en entornos de uso intensivo como hoteles, resorts y alojamientos institucionales.",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Full 83x91\"",
                                "tags": "duvet cover, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Duvet Cover de 250 hilos - Queen",
                                "descripcion": "Duvet cover hotelero de 250 hilos en percale blanco, composición 60% algodón y 40% poliéster. Suave, fresco y resistente. Disponible en tamaños Twin, Full, Queen y King.",
                                "detalles": "Nuestro duvet cover hotelero de 250 hilos en percale blanco está confeccionado con una equilibrada composición de 60% algodón y 40% poliéster, diseñada para ofrecer máximo confort, frescura y alta durabilidad en entornos de uso intensivo como hoteles, resorts y alojamientos institucionales.",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Queen 91x91\"",
                                "tags": "duvet cover, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Duvet Cover de 250 hilos - King",
                                "descripcion": "Duvet cover hotelero de 250 hilos en percale blanco, composición 60% algodón y 40% poliéster. Suave, fresco y resistente. Disponible en tamaños Twin, Full, Queen y King.",
                                "detalles": "Nuestro duvet cover hotelero de 250 hilos en percale blanco está confeccionado con una equilibrada composición de 60% algodón y 40% poliéster, diseñada para ofrecer máximo confort, frescura y alta durabilidad en entornos de uso intensivo como hoteles, resorts y alojamientos institucionales.",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "King 107x91\"",
                                "tags": "duvet cover, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Sabanas Encimera de 250 hilos - Twin",
                                "descripcion": "Nuestra linea hotelera de 250 hilos percale blanco, composición 60% algodón y 40% poliéster. Más suave, fresca y resistente.",
                                "detalles": "Nuestra sábana hotelera de 250 hilos percale está elaborada con una resistente y confortable composición de 60% algodón y 40% poliéster, diseñada especialmente para cumplir con los más altos estándares del sector hotelero.\n\nEl tejido percale de 250 hilos ofrece una textura más fina, suave y fresca al tacto, proporcionando una experiencia superior de descanso al huésped, sin sacrificar la durabilidad y resistencia necesarias para el lavado industrial continuo.",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Twin 66x115\"",
                                "tags": "flat sheet, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Sabanas Encimera de 250 hilos - Full",
                                "descripcion": "Nuestra linea hotelera de 250 hilos percale blanco, composición 60% algodón y 40% poliéster. Más suave, fresca y resistente.",
                                "detalles": "Nuestra sábana hotelera de 250 hilos percale está elaborada con una resistente y confortable composición de 60% algodón y 40% poliéster, diseñada especialmente para cumplir con los más altos estándares del sector hotelero.\n\nEl tejido percale de 250 hilos ofrece una textura más fina, suave y fresca al tacto, proporcionando una experiencia superior de descanso al huésped, sin sacrificar la durabilidad y resistencia necesarias para el lavado industrial continuo.",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Full 81x115\"",
                                "tags": "flat sheet, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Sabanas Encimera de 250 hilos - Queen",
                                "descripcion": "Nuestra linea hotelera de 250 hilos percale blanco, composición 60% algodón y 40% poliéster. Más suave, fresca y resistente.",
                                "detalles": "Nuestra sábana hotelera de 250 hilos percale está elaborada con una resistente y confortable composición de 60% algodón y 40% poliéster, diseñada especialmente para cumplir con los más altos estándares del sector hotelero.\n\nEl tejido percale de 250 hilos ofrece una textura más fina, suave y fresca al tacto, proporcionando una experiencia superior de descanso al huésped, sin sacrificar la durabilidad y resistencia necesarias para el lavado industrial continuo.",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Queen 90x120\"",
                                "tags": "flat sheet, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Sabanas Encimera de 250 hilos - King",
                                "descripcion": "Nuestra linea hotelera de 250 hilos percale blanco, composición 60% algodón y 40% poliéster. Más suave, fresca y resistente.",
                                "detalles": "Nuestra sábana hotelera de 250 hilos percale está elaborada con una resistente y confortable composición de 60% algodón y 40% poliéster, diseñada especialmente para cumplir con los más altos estándares del sector hotelero.\n\nEl tejido percale de 250 hilos ofrece una textura más fina, suave y fresca al tacto, proporcionando una experiencia superior de descanso al huésped, sin sacrificar la durabilidad y resistencia necesarias para el lavado industrial continuo.",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "King 114x120\"",
                                "tags": "flat sheet, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Sabanas ajustable de 250 hilos - Twin",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Twin 39x80x14\"",
                                "tags": "fitted sheet, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Sabanas ajustable de 250 hilos - Full",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Full 54x80x14\"",
                                "tags": "fitted sheet, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Sabanas ajustable de 250 hilos - Queen",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Queen 60x80x14\"",
                                "tags": "fitted sheet, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Sabanas ajustable de 250 hilos - King",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "King 78x80x14\"",
                                "tags": "fitted sheet, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Fundas de Almohada 250 hilos - Estandar",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Standard 21x30\"",
                                "tags": "pillowcase, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Fundas de Almohada 250 hilos - Queen",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Queen 21x35\"",
                                "tags": "pillowcase, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 250 Hilos Algodon",
                                "subcategoria": "Percale",
                                "nombre": "Fundas de Almohada 250 hilos - King",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "250 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "King 21x42\"",
                                "tags": "pillowcase, 250 hilos, percale"
                            },
                            {
                                "categoria": "Linea 200 Hilos Algodon",
                                "subcategoria": "Sábana Encimera",
                                "nombre": "Sabanas Encimera de 200 hilos - Twin",
                                "descripcion": "Nuestra Linea de 200 hilos percale blanco, con composición 60% algodón y 40% poliéster. Color blanco, fresca, suave y resistente, ideal para uso hotelero.",
                                "detalles": "Está fabricada con una composición de 60% algodón y 40% poliéster en tejido percal, ideal para uso institucional y hotelero por su excelente equilibrio entre suavidad, resistencia y fácil mantenimiento.\n\nLa mezcla 60/40 garantiza una sensación fresca y confortable, al mismo tiempo que ofrece mayor durabilidad, menor encogimiento y mejor comportamiento al lavado industrial, características esenciales para hoteles, hospitales y lavanderías comerciales.\n\nSu acabado en color blanco permite mantener los más altos estándares de presentación, higiene y elegancia en habitaciones de alto tráfico.",
                                "color": "Blanco",
                                "marca": "200 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Twin 70x115”",
                                "tags": "flat sheet, 200 hilos, percale"
                            },
                            {
                                "categoria": "Linea 200 Hilos Algodon",
                                "subcategoria": "Sábana Encimera",
                                "nombre": "Sabanas Encimera de 200 hilos - Full",
                                "descripcion": "Nuestra Linea de 200 hilos percale blanco, con composición 60% algodón y 40% poliéster. Color blanco, fresca, suave y resistente, ideal para uso hotelero.",
                                "detalles": "Está fabricada con una composición de 60% algodón y 40% poliéster en tejido percal, ideal para uso institucional y hotelero por su excelente equilibrio entre suavidad, resistencia y fácil mantenimiento.\n\nLa mezcla 60/40 garantiza una sensación fresca y confortable, al mismo tiempo que ofrece mayor durabilidad, menor encogimiento y mejor comportamiento al lavado industrial, características esenciales para hoteles, hospitales y lavanderías comerciales.\n\nSu acabado en color blanco permite mantener los más altos estándares de presentación, higiene y elegancia en habitaciones de alto tráfico.",
                                "color": "Blanco",
                                "marca": "200 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Full 81x115”",
                                "tags": "flat sheet, 200 hilos, percale"
                            },
                            {
                                "categoria": "Linea 200 Hilos Algodon",
                                "subcategoria": "Sábana Encimera",
                                "nombre": "Sabanas Encimera de 200 hilos - Queen",
                                "descripcion": "Nuestra Linea de 200 hilos percale blanco, con composición 60% algodón y 40% poliéster. Color blanco, fresca, suave y resistente, ideal para uso hotelero.",
                                "detalles": "Está fabricada con una composición de 60% algodón y 40% poliéster en tejido percal, ideal para uso institucional y hotelero por su excelente equilibrio entre suavidad, resistencia y fácil mantenimiento.\n\nLa mezcla 60/40 garantiza una sensación fresca y confortable, al mismo tiempo que ofrece mayor durabilidad, menor encogimiento y mejor comportamiento al lavado industrial, características esenciales para hoteles, hospitales y lavanderías comerciales.\n\nSu acabado en color blanco permite mantener los más altos estándares de presentación, higiene y elegancia en habitaciones de alto tráfico.",
                                "color": "Blanco",
                                "marca": "200 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Queen 94x115”",
                                "tags": "flat sheet, 200 hilos, percale"
                            },
                            {
                                "categoria": "Linea 200 Hilos Algodon",
                                "subcategoria": "Sábana Encimera",
                                "nombre": "Sabanas Encimera de 200 hilos - King",
                                "descripcion": "Nuestra Linea de 200 hilos percale blanco, con composición 60% algodón y 40% poliéster. Color blanco, fresca, suave y resistente, ideal para uso hotelero.",
                                "detalles": "Está fabricada con una composición de 60% algodón y 40% poliéster en tejido percal, ideal para uso institucional y hotelero por su excelente equilibrio entre suavidad, resistencia y fácil mantenimiento.\n\nLa mezcla 60/40 garantiza una sensación fresca y confortable, al mismo tiempo que ofrece mayor durabilidad, menor encogimiento y mejor comportamiento al lavado industrial, características esenciales para hoteles, hospitales y lavanderías comerciales.\n\nSu acabado en color blanco permite mantener los más altos estándares de presentación, higiene y elegancia en habitaciones de alto tráfico.",
                                "color": "Blanco",
                                "marca": "200 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "King 115x115”",
                                "tags": "flat sheet, 200 hilos, percale"
                            },
                            {
                                "categoria": "Linea 200 Hilos Algodon",
                                "subcategoria": "Sábana Ajustable",
                                "nombre": "Sabanas ajustable de 200 hilos - Twin",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "200 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Twin 39x80+13\"",
                                "tags": "fitted sheet, 200 hilos, percale"
                            },
                            {
                                "categoria": "Linea 200 Hilos Algodon",
                                "subcategoria": "Sábana Ajustable",
                                "nombre": "Sabanas ajustable de 200 hilos - Full",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "200 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Full 54x80+13\"",
                                "tags": "fitted sheet, 200 hilos, percale"
                            },
                            {
                                "categoria": "Linea 200 Hilos Algodon",
                                "subcategoria": "Sábana Ajustable",
                                "nombre": "Sabanas ajustable de 200 hilos - Queen",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "200 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Queen 60x80+13\"",
                                "tags": "fitted sheet, 200 hilos, percale"
                            },
                            {
                                "categoria": "Linea 200 Hilos Algodon",
                                "subcategoria": "Sábana Ajustable",
                                "nombre": "Sabanas ajustable de 200 hilos - King",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "200 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "King 80x80+13\"",
                                "tags": "fitted sheet, 200 hilos, percale"
                            },
                            {
                                "categoria": "Linea 200 Hilos Algodon",
                                "subcategoria": "Funda de Almohada",
                                "nombre": "Fundas de Almohada de 200 hilos - Estandar",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "200 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "Standard 20x31\"",
                                "tags": "pillowcase, 200 hilos, percale"
                            },
                            {
                                "categoria": "Linea 200 Hilos Algodon",
                                "subcategoria": "Funda de Almohada",
                                "nombre": "Fundas de Almohada de 200 hilos - King",
                                "descripcion": "",
                                "detalles": "",
                                "color": "Blanco",
                                "marca": "200 Hilos - 60% algodón / 40% poliéster - Percale",
                                "talla": "King 20x40\"",
                                "tags": "pillowcase, 200 hilos, percale"
                            }
                            ]
JSON;
        $productos = json_decode($productosJson, true);


        $bar = $this->output->createProgressBar(count($productos));
        $bar->start();

        foreach ($productos as $item) {
            
            // 1. Gestionar Categoría
            $categoriaNombre = trim($item['categoria']);
            $categoria = Categoria::where('nombre', $categoriaNombre)->where('padre_id', null)->first();

            if (!$categoria) {
                $categoria = Categoria::create([
                    'nombre' => $categoriaNombre,
                    // 'slug' => Str::slug($categoriaNombre),
                    'estatus' => 1, // Activo por defecto
                    'padre_id' => null,
                ]);
                $this->info(" Categoría creada: " . $categoriaNombre);
            }

            // 2. Gestionar Subcategoría
            $subcategoriaNombre = trim($item['subcategoria']);
            $subcategoria = Categoria::where('nombre', $subcategoriaNombre)
                                    ->where('padre_id', $categoria->id)
                                    ->first();

            if (!$subcategoria) {
                $subcategoria = Categoria::create([
                    'nombre' => $subcategoriaNombre,
                    // 'slug' => Str::slug($subcategoriaNombre . '-' . $categoria->id), // Slug único
                    'estatus' => 1,
                    'padre_id' => $categoria->id,
                ]);
                $this->info(" Subcategoría creada: " . $subcategoriaNombre);
            }

            // 3. Crear o Actualizar Producto
            $productoNombre = trim($item['nombre']);
            
            // Buscamos por nombre y categoría para evitar duplicados exactos
            $producto = Producto::where('nombre', $productoNombre)
                                ->where('categoria_id', $categoria->id)
                                ->where('subcategoria_id', $subcategoria->id)
                                ->first();

            $datosProducto = [
                'nombre' => $productoNombre,
                // 'slug' => Str::slug($productoNombre . '-' . mt_rand(1000,9999)),
                'categoria_id' => $categoria->id,
                'subcategoria_id' => $subcategoria->id,
                'descripcion' => isset($item['descripcion']) ? $item['descripcion'] : null,
                'marca' => isset($item['marca']) ? trim($item['marca']) : null,
                'marca_id' => null,
                'estatus' => 1,
                
                // Campos adicionales
                'tags' => isset($item['tags']) ? $item['tags'] : null, // Mapeado de tags a SKU
                'talla' => isset($item['talla']) ? $item['talla'] : null,
                'medida' => isset($item['detalles']) ? $item['detalles'] : null, // Mapeado de detalles a medida (si existe)
                'color' => isset($item['color']) ? $item['color'] : null,
            ];

            if ($producto) {
                $producto->update($datosProducto);
            } else {
                $producto = Producto::create($datosProducto);
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Importación completada con éxito.');

        return Command::SUCCESS;
    }
}
