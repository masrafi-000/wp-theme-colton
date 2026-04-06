(function($) {
    'use strict';

    /**
     * Research Tools (COA Tabs, Modals, Peptide Calculator)
     */
    var initResearchTools = function() {
        // COA Tabs Logic
        const coaData = {
            semaglutide: [
                { name: "Semaglutide 5mg", batch: "11102025SM", purity: "99.174%", date: "22 JAN 2026", key: "07392999be2a" },
                { name: "Semaglutide 10mg", batch: "1052026SM", purity: "99.524%", date: "16 FEB 2026", key: "f0974fac305f" },
                { name: "Semaglutide 15mg", batch: "11092025SM", purity: "99.791%", date: "22 JAN 2026", key: "9e71f2a8a152" }
            ],
            bpc157: [
                { name: "BPC-157 5mg", batch: "20250115BPC", purity: "99.821%", date: "15 JAN 2026", key: "7c2f8a1d5e4b" },
                { name: "BPC-157 10mg", batch: "20250210BPC", purity: "99.914%", date: "10 FEB 2026", key: "4d9e1c3b7a5f" },
                { name: "BPC-157 5mg (Arg)", batch: "20250301BPC", purity: "99.752%", date: "01 MAR 2026", key: "1a5c3e7b9d2f" }
            ],
            ipamorelin: [
                { name: "Ipamorelin 2mg", batch: "20250120IPA", purity: "98.941%", date: "20 JAN 2026", key: "9b3d7f1e5a4c" },
                { name: "Ipamorelin 5mg", batch: "20250225IPA", purity: "99.112%", date: "25 FEB 2026", key: "3f5a7d1c9e2b" },
                { name: "Ipamorelin 10mg", batch: "20250315IPA", purity: "99.428%", date: "15 MAR 2026", key: "7e1c3b5a9d4f" }
            ]
        };

        $(document).on('click', '.coa-tab-btn', function() {
            var $btn = $(this);
            var product = $btn.data('product');
            var $grid = $('#coa-grid');
            
            $('.coa-tab-btn').removeClass('bg-primary text-white active')
                           .addClass('border border-primary text-primary');
            $btn.addClass('bg-primary text-white active')
                .removeClass('border border-primary text-primary');

            if (coaData[product]) {
                var html = coaData[product].map(function(batch) {
                    return `
                        <div class="bg-white rounded-3xl border border-secondary p-8 shadow-sm text-left animate-fade-in">
                            <div class="bg-primary p-4 px-6 rounded-xl mb-6 font-bold text-white opacity-90">${batch.name}</div>
                            <div class="text-sm text-muted-foreground leading-[2] space-y-2">
                                <p><strong class="text-foreground">Batch:</strong> ${batch.batch}</p>
                                <p><strong class="text-foreground">Purity:</strong> ${batch.purity}</p>
                                <p><strong class="text-foreground">Date:</strong> ${batch.date}</p>
                                <p><strong class="text-foreground">Lab:</strong> Janoshik Laboratories</p>
                                <p><strong class="text-foreground">Key:</strong> ${batch.key}</p>
                            </div>
                        </div>
                    `;
                }).join('');
                $grid.html(html);
            }
        });

        // Modals Management
        window.openResourceModal = function(id) {
            var $modal = $('#modal-' + id);
            if ($modal.length) {
                $modal.removeClass('hidden').addClass('flex');
                $('body').addClass('overflow-hidden');
            }
        };

        window.closeResourceModal = function(id) {
            var $modal = $('#modal-' + id);
            if ($modal.length) {
                $modal.addClass('hidden').removeClass('flex');
                $('body').removeClass('overflow-hidden');
            }
        };

        $(document).on('click', '[id^="modal-"]', function(e) {
            if (e.target === this) {
                var id = this.id.replace('modal-', '');
                window.closeResourceModal(id);
            }
        });

        // Peptide Calculator Logic
        var calculate = function() {
            var mg = parseFloat($('#calc-mg').val()) || 0;
            var ml = parseFloat($('#calc-water').val()) || 1;
            var mcgDose = parseFloat($('#calc-dose').val()) || 0;

            var concentrationMgMl = mg / ml;
            var concentrationMcgMl = concentrationMgMl * 1000;
            
            var drawMl = 0;
            if (concentrationMcgMl > 0) {
                drawMl = mcgDose / concentrationMcgMl;
            }
            
            var units = drawMl * 100;

            $('#calc-res-concentration').text(concentrationMgMl.toFixed(2) + ' mg/mL');
            $('#calc-res-ml').text(drawMl.toFixed(3) + ' mL');
            $('#calc-res-units').text(Math.round(units) + ' Units');
        };

        $(document).on('input', '#peptide-calc-form input', calculate);
        if ($('#peptide-calc-form').length > 0) {
            calculate();
        }
    };

    $(document).ready(function() {
        initResearchTools();
    });

})(jQuery);
