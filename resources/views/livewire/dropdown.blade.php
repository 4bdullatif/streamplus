<div @if($wireIgnore) wire:ignore @endif>
    <select id="{{ $elementId }}" class="{{ $class }}" data-id="{{ $modelValueKey }}" style="width: 100%;">
    </select>
</div>

@pushonce('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initSelect2();

            function initSelect2(config = {
                elementId: '#{{$elementId}}',
                ajaxUrl: '{{ $ajaxUrl }}',
                placeholder: '{{ $placeholder }}',
                minimumInputLength: {{ $minimumInputLength }},
                params: @json($params),
                modelValueKey: '{{ $modelValueKey }}'
            }) {
                const element = document.querySelector(config.elementId);

                const tomScotConfig = {
                    valueField: 'id',
                    labelField: 'text',
                    searchField: 'text',
                    load: function(query, callback) {
                        const searchParams = new URLSearchParams();
                        searchParams.append('term', query);
                        Object.keys(config.params).forEach(key => {
                            searchParams.append(key, config.params[key]);
                        });

                        fetch(config.ajaxUrl + '?' + searchParams.toString())
                            .then(response => response.json())
                            .then(data => {
                                callback(data.data.map(function(item) {
                                    return {
                                        id: item.id,
                                        text: item.name,
                                        ...item // Spread any additional data into the item
                                    };
                                }));
                            }).catch(() => {
                            callback(); // Handle errors
                        });
                    },
                    placeholder: config.placeholder,
                    allowEmptyOption: true, // Equivalent to allowClear in Select2
                    onChange: function(value) {
                        if (value) {
                            Livewire.dispatchTo('dropdown', 'valueUpdated', {
                                key: config.modelValueKey,
                                value: this.options[value],
                            });
                        }
                    }
                };

                if (element && element.tomselect) {
                    element.tomselect.options.load = tomScotConfig.load;
                } else {
                    new TomSelect(config.elementId, tomScotConfig);
                }

            }

            Livewire.hook('component.init', ({ component, cleanup }) => {
                console.log(component);
                if (component.name === 'dropdown') {
                    const snapShotData = component.snapshot;
                    initSelect2({
                        elementId: '#' + snapShotData.data.elementId,
                        ajaxUrl: snapShotData.data.ajaxUrl,
                        placeholder: snapShotData.data.placeholder,
                        minimumInputLength: snapShotData.data.minimumInputLength,
                        params: snapShotData.data.params.reduce((acc, item) => {
                            return {...acc, ...item};
                        }, {}),
                        modelValueKey: snapShotData.data.modelValueKey
                    });
                }
            })

            initSelect2();
        });
    </script>

@endpushonce
