/**
 *  Customizer Controls
 */

(function(api) {

    api.bind('ready', function() {

        api.section('title_tagline').panel('itreHeaderPanel');
        api.section('header_image').panel('itreHeaderPanel');
        api.section('colors').priority(80);

        api.panel.add(
            new api.Panel(
                'itreHeaderPanel', {
                    title     : 'Header',
                    priority  :   50
                }
            )
        );

        api.section.add(
            new api.Section(
                'itreHeaderOptions', {
                    title: 'Header Options',
                    priority: 30,
                    panel: 'itreHeaderPanel',
                    customizeAction: 'Customizing ▸ Header Options'
                }
            )
        );

        api.control.add(
            new api.Control(
                'itreHeader', {
                    label:  'Header Layout',
                    description: 'Select the Layout of Header (Home Page)',
                    section: 'itreHeaderOptions',
                    settings: 'itreHeaderLayout',
                    type: 'radio',
                    priority: 40,
                    choices: {
                        headerDefault: 'Header - Default',
                        headerSlider: 'Header - Slider',
                        headerVideo: 'Header - Video'
                    }
                }
            )
        );

    })

})(wp.customize)
