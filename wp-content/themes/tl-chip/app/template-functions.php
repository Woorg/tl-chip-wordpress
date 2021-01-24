<?php

    // Add style attributes

    // function abp_app_style_add_attributes( $html, $handle ) {
    //     if ( 'main-prod' === $handle ) {
    //         return str_replace( "media='all'", "media='print' onload=this.media='all'", $html );
    //     }
    //     else if ('main-dev' === $handle) {
    //         return str_replace("media='all'", "media='print' onload=this.media='all'", $html);
    //     }

    //     else if ('wp-block-library' === $handle) {
    //         return str_replace("media='all'", "media='print' onload=this.media='all'", $html);
    //     }
    //     else if ('contact-form-7' === $handle) {
    //         return str_replace("media='all'", "media='print' onload=this.media='all'", $html);
    //     }

    //     return $html;
    //   }
    // add_filter( 'style_loader_tag', 'abp_app_style_add_attributes', 10, 2 );


    // function _remove_script_version( $src ){
    //     $parts = explode( '?ver', $src );
    //     return $parts[0];
    // }

    // add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
    // add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );


    // Change nav item class

    function tlchip_add_additional_class_on_li($classes, $item, $args)
    {
        if ($args->theme_location === 'menu-1'):
            $classes[] = 'nav__item';
        elseif ($args->theme_location === 'menu-2'):
            $classes[] = 'nav-sec__item';
        elseif ($args->theme_location === 'menu-3') :
            $classes[] = 'nav-sec__item';
        endif;
        return $classes;
    }
    add_filter('nav_menu_css_class', 'tlchip_add_additional_class_on_li', 1, 3);


    // Change nav link class

    function tlchip_filter_nav_menu_link_attributes($atts, $item, $args, $depth)
    {
        //  var_dump($item);

        if ($args->theme_location === 'menu-1') :
            $atts['class'] = 'nav__link';
        elseif ($args->theme_location === 'menu-2') :
            $atts['class'] = 'nav-sec__link';
        elseif ($args->theme_location === 'menu-3') :
            $atts['class'] = 'nav-sec__link';
        endif;
        return $atts;
    }
    add_filter('nav_menu_link_attributes', 'tlchip_filter_nav_menu_link_attributes', 10, 4);


    // ACF

    if (function_exists('acf_add_options_page')) {

        acf_add_options_page(
            [
                'page_title' => 'Настройки tl-chip',
                'menu_title' => 'Настройки tl-chip',
                'menu_slug' => 'theme-settings',
                'capability' => 'edit_posts',
                'icon_url' => 'dashicons-admin-settings',
                'redirect' => false
            ]

        );

        acf_add_options_page(
            [
                'page_title'    => 'Catalog Options',
                'menu_title'    => 'Catalog Options',
                'menu_slug'     => 'catalog-options',
                'capability'    => 'edit_posts',
                'parent_slug'   => 'edit.php?post_type=cars',
                'position'      => false,
                'icon_url'      => 'dashicons-admin-settings',
                'redirect'      => true,
            ]

        );

    }



    // Contacts form 7

    // add_filter('wpcf7_form_elements', function ($content) {
    //     $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    //     return $content;
    // });



    // Parth to svg sprite

    function svg_sprite_paths() {

        $path = get_template_directory_uri() . '/front/static/prod/svg-symbols.svg';
        return $path;
    }


    // Parth to fonts

    function fonts_paths()
    {

        $path = get_template_directory_uri() . '/front/static/prod/assets/fonts';
        return $path;
    }

    // Excerpt length

    add_filter('excerpt_length', function () {
        return 35;
    });

    // Excerpt more

    /**
     * Обрезка текста (excerpt). Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
     *
     * @param string/array $args Параметры.
     *
     * @return string HTML
     *
     * @ver 2.6.5
     */
    function abp_excerpt($args = '')
    {
        global $post;

        if (is_string($args))
            parse_str($args, $args);

        $rg = (object) array_merge(array(
            'maxchar'     => 350,   // Макс. количество символов.
            'text'        => '',    // Какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
            // Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется
            // все до <!--more--> вместе с HTML.
            'autop'       => true,  // Заменить переносы строк на <p> и <br> или нет?
            'save_tags'   => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'.
            'more_text'   => 'Читать дальше...', // Текст ссылки `Читать дальше`.
            'ignore_more' => false, // нужно ли игнорировать <!--more--> в контенте
        ), $args);

        $rg = apply_filters('kama_excerpt_args', $rg);

        if (!$rg->text)
            $rg->text = $post->post_excerpt ?: $post->post_content;

        $text = $rg->text;
        // убираем блочные шорткоды: [foo]some data[/foo]. Учитывает markdown
        $text = preg_replace('~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text);
        // убираем шоткоды: [singlepic id=3]. Учитывает markdown
        $text = preg_replace('~\[/?[^\]]*\](?!\()~', '', $text);
        $text = trim($text);

        // <!--more-->
        if (!$rg->ignore_more  &&  strpos($text, '<!--more-->')) {
            preg_match('/(.*)<!--more-->/s', $text, $mm);

            $text = trim($mm[1]);

            $text_append = ' <a href="' . get_permalink($post) . '#more-' . $post->ID . '">' . $rg->more_text . '</a>';
        }
        // text, excerpt, content
        else {
            $text = trim(strip_tags($text, $rg->save_tags));

            // Обрезаем
            if (mb_strlen($text) > $rg->maxchar) {
                $text = mb_substr($text, 0, $rg->maxchar);
                $text = preg_replace('~(.*)\s[^\s]*$~s', '\\1...', $text); // кил последнее слово, оно 99% неполное
            }
        }

        // сохраняем переносы строк. Упрощенный аналог wpautop()
        if ($rg->autop) {
            $text = preg_replace(
                array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
                array('',     '</p><p>',  '<br />', '</p>'),
                $text
            );
        }

        $text = apply_filters('kama_excerpt', $text, $rg);

        if (isset($text_append))
            $text .= $text_append;

        return ($rg->autop && $text) ? "<p>$text</p>" : $text;
    }



    // Allow webp upload

    /**
     * Sets the extension and mime type for .webp files.
     *
     * @param array  $wp_check_filetype_and_ext File data array containing 'ext', 'type', and
     *                                          'proper_filename' keys.
     * @param string $file                      Full path to the file.
     * @param string $filename                  The name of the file (may differ from $file due to
     *                                          $file being in a tmp directory).
     * @param array  $mimes                     Key is the file extension with value as the mime type.
     */
    function abp_file_and_ext_webp($types, $file, $filename, $mimes)
    {
        if (false !== strpos($filename, '.webp')) {
            $types['ext'] = 'webp';
            $types['type'] = 'image/webp';
        }

        return $types;
    }
    add_filter('wp_check_filetype_and_ext', 'abp_file_and_ext_webp', 10, 4);

    /**
     * Adds webp filetype to allowed mimes
     *
     * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
     *
     * @param array $mimes Mime types keyed by the file extension regex corresponding to
     *                     those types. 'swf' and 'exe' removed from full list. 'htm|html' also
     *                     removed depending on '$user' capabilities.
     *
     * @return array
     */

    function abp_mime_types_webp($mimes)
    {
        $mimes['webp'] = 'image/webp';


        return $mimes;
    }
    add_filter('upload_mimes', 'abp_mime_types_webp');




/**
 * Выводит ссылку (HTML тег A) на смежные записи (следующая/предыдущая).
 *
 * При отсутствии смежной записи выводит запись с противоположного конца рубрики. Работает в пределах той рубрики, где находится сама запись.
 *
 * @param string $course принимает значение next/prev.
 */
function da_the_adjacent_post_link( $course = '' ){
  global $post;
  $course = ( $course == 'prev' ) ? true : false;
  $order  = ( $course ) ? 'DESC' : 'ASC';
  $class  = ( $course ) ? ' prev' : ' next';

  $link = get_adjacent_post_link( '%link', '%title', true, '', $course, );

  if ( ! $link ){
    $term = get_the_terms( get_the_ID(), null );
    $term = $term[0];
    $article = get_posts([
      'numberposts' => 9999,
      'exclude'     => $post->ID,
      'post_type' => 'cars',
      'category'    => 'car-brand',
      'term'    => $term-slug,

      'order'       => $order
    ]);

    // var_dump($article);

    if ( empty($article) )
      return false;
    else
      $article = $article[0];

    $link = sprintf( '<a href="%s" class="car__back" rel="%s"><svg class="car__back-icon" width="22px" height="14px"><use xlink:href="' . get_template_directory_uri() . '/front/static/prod/svg-symbols.svg#video-arrow"></use></svg> %s</a>', get_the_permalink($article->ID), $class, $article->post_title );
  }

  return $link;
}



/**
 * Предыдущие записи из рубрики (относительно текущей записи) +
 * кольцевая перелинковка (можно указывать таксономию и тип записи)
 *
 * Вызываем функцию так:
 * <?php echo kama_previous_posts_from_tax( array( 'post_num'=>5, 'format'=>'{date:j.M.Y} - {a}{title}{/a}' ); ?>
 *
 * ver 1.0
 */
function kama_previous_posts_from_tax( $args = array() ){
    global $post, $wpdb;

    // Параметры передаваемые функции
    $args = (object) wp_parse_args( $args, array(
        'post_num'  => 1,          // количество ссылок
        'format'    => '',         // {thumb} {date:j.M.Y} - {a}{title}{/a} ({comments})
        'cache'     => false,       // включить или нет объектное кэширование
        'list_tag'  => '',       // тег-обертка каждой ссылки
        'tax'       => 'category', // таксономия. пр. category
        'post_type' => 'cars',     // тип записи. пр. post
    ) );

    $cache_key = md5( __FUNCTION__ . $post->ID );
    $cache_flag = __FUNCTION__;
    if ( $args->cache && $cache_out = wp_cache_get($cache_key, $cache_flag) )
        return $cache_out;

    $tax_id = $wpdb->prepare( "SELECT term_id FROM $wpdb->term_relationships rl LEFT JOIN $wpdb->term_taxonomy tx ON (rl.term_taxonomy_id = tx.term_taxonomy_id) WHERE object_id = %d AND tx.taxonomy = %s LIMIT 1", $post->ID, $args->tax );

    $same_join = "SELECT ID, post_title, post_date, comment_count, guid
    FROM $wpdb->posts p
        LEFT JOIN $wpdb->term_relationships rel ON (p.ID = rel.object_id)
        LEFT JOIN $wpdb->term_taxonomy tax ON (rel.term_taxonomy_id = tax.term_taxonomy_id)";

    $same_and = "AND tax.term_id = ($tax_id) AND tax.taxonomy = '". esc_sql($args->tax) ."' AND p.post_status = 'publish' AND p.post_type = '". esc_sql($args->post_type) ."' ORDER BY p.post_date DESC";

    $sql = "$same_join WHERE p.post_date < '". esc_sql($post->post_date) ."' $same_and LIMIT ". intval( $args->post_num );

    $res = $wpdb->get_results( $sql );

    $count_res = count( $res );

    // если количество меньше нужного, делаем 2-й запрос (кольцевая перелинковка)
    if ( ! $res || $count_res < $args->post_num ){
        $NOT_IN = $post->ID;
        foreach( $res as $id ) $NOT_IN .= ",$id->ID";
        $sql = "$same_join WHERE p.ID NOT IN ($NOT_IN) $same_and LIMIT ". intval($args->post_num - $count_res);

        $res2 = $wpdb->get_results($sql);

        $res = array_merge( $res, $res2 );
    }

    if( ! $res )
        return false;

    // Формировка вывода
    if ( $args->format )
        preg_match( '!{date:(.*?)}!', $args->format, $date_m );
    if ( false !== strpos($args->format, '{thumb}') )
        $add_thumb = 1;

    $out = '';
    foreach( $res as $pst ){
        $x = (@ $x == 'li1') ?  'li2' : 'li1';

        $a = '<a class="car__back" href="'. get_permalink($pst->ID) .'" title="'. esc_attr($pst->post_title) .'">'; //get_permalink($pst->ID) меняем на $pst->guid если настроено поле guid

        if( $args->format ){
            $formated = strtr( $args->format, array(
                '{title}'    => esc_html($pst->post_title),
                '{a}'        => $a,
                '{/a}'       => '<svg class="car__back-icon" width="22px" height="14px"><use xlink:href="' . get_template_directory_uri() . '/front/static/prod/svg-symbols.svg#video-arrow"></use></svg></a>',
                '{comments}' => ($pst->comment_count==0) ? '' : $pst->comment_count,
            ) );

            // есть дата
            if( $date_m ){
                $formated = str_replace( $date_m[0], apply_filters('the_time', mysql2date($date_m[1], $pst->post_date)), $formated );
            }
            // есть миниатюра
            if( isset($add_thumb) ){
                $formated = str_replace('{thumb}', get_the_post_thumbnail( $pst->ID, 'thumbnail' ), $formated );
            }
        }
        else {
            $formated = $a . esc_html($pst->post_title) .'</a>';
        }

        $out .= "\t<li class='$x'>$formated</li>\n";
    }

    if( $args->cache ) wp_cache_add( $cache_key, $out, $cache_flag );

    return '<ul>'. $out .'</ul>';
}


// function modify_filter_button($string){

// }

// add_filter('beautiful_filters_apply_button', 'modify_filter_button', 10, 1);