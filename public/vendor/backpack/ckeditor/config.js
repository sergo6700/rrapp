/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    config.contentsCss = [
        CKEDITOR.getUrl('fonts.css'),
        CKEDITOR.getUrl('my_styles.css')
    ];

    //the next line add the new font to the combobox in CKEditor
    config.font_names = 'PT Sans Narrow Regular;' + config.font_names;
    config.font_names = 'PT Sans Narrow Bold;' + config.font_names;
    config.font_names = 'PT Sans Regular;' + config.font_names;
    config.font_names = 'PT Sans Italic;' + config.font_names;
    config.font_names = 'PT Sans Bold;' + config.font_names;
    config.font_names = 'PT Sans Bold Italic;' + config.font_names;

    config.font_names = 'Open Sans ExtraBold Italic;' + config.font_names;
    config.font_names = 'Open Sans Italic;' + config.font_names;
    config.font_names = 'Open Sans Light;' + config.font_names;
    config.font_names = 'Open Sans Regular;' + config.font_names;
    config.font_names = 'Open Sans Semibold Italic;' + config.font_names;

    config.font_names = 'CirceMD Bold;' + config.font_names;
    config.font_names = 'CirceMD Extra Bold;' + config.font_names;
};


/**
 * ссылка на online builder
 * https://ckeditor.com/cke4/builder
 *
 * Памятка!
 * В редактор были добавлены дополнительные плагины:
 *  добавил папку со шрифтами
 *  Font Size and Family
 *  Line Height
 *  Imageresponsive
 *  Paragraph Indentation
 *  Auto Embed
 *  Media (oEmbed) Plugin
 */