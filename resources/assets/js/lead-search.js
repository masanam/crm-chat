/**
 * App Chat
 */

 'use strict';

 document.addEventListener('DOMContentLoaded', function () {
   (async function () {
    // variable form filters
    let searchPeopleValue, ageValue, locationsValue = [], incomeValue, jobValue;

    /**
     * @description handle change icon chevron right/up
     * @param {Element} element jquery or element html 
     */
    const handleChangeIconFilter = function(element) {
        if (!element) return

        const elTarget = element[0].previousElementSibling
        if (element.is(':visible')) {
            elTarget.querySelector('.ti').classList.remove('ti-chevron-right')
            elTarget.querySelector('.ti').classList.add('ti-chevron-up')
        } else {
            elTarget.querySelector('.ti').classList.remove('ti-chevron-up')
            elTarget.querySelector('.ti').classList.add('ti-chevron-right')
        }
    }

    /**
     * @description handle input search people
     */
    $('input[name="search_people"]').on('keyup', (e) => {
        e.preventDefault();
        const value = e.target.value
        searchPeopleValue = value
    });
    $('input[name="search_people"]').on('focus', () => {
        $('.btn-search').css({ top: '65px' })
    })
    $('input[name="search_people"]').on('focusout', () => {
        $('.btn-search').css({ top: '63px' })
    })

    /**
     * @description handle hide/show all filter
     */
    $('#filter-age').on('click', function() {
        const content = $('#content-filter-age')
        content.toggle();
        handleChangeIconFilter(content)
    });
    $('#filter-gender').on('click', function() {
        const content = $('#content-filter-gender')
        content.toggle();
        handleChangeIconFilter(content)
    });
    $('#filter-location').on('click', function() {
        const content = $('#content-filter-location')
        const elTarget = content[0].previousElementSibling
        
        if (content.hasClass('hide')) {
            content.removeClass('hide')
            content.css({ display: 'flex', flexDirection: 'column', gap: '1rem' })
            elTarget.querySelector('.ti').classList.remove('ti-chevron-right')
            elTarget.querySelector('.ti').classList.add('ti-chevron-up')
        } else {
            content.addClass('hide')
            content.css({ display: 'none' })
            elTarget.querySelector('.ti').classList.remove('ti-chevron-up')
            elTarget.querySelector('.ti').classList.add('ti-chevron-right')
        }
    });
    $('#filter-income').on('click', function() {
        const content = $('#content-filter-income')
        content.toggle();
        handleChangeIconFilter(content)
    });
    $('#filter-job').on('click', function() {
        const content = $('#content-filter-job')
        content.toggle();
        handleChangeIconFilter(content)
    });


    /**
     * @description handle event enter field locations
     */
    $('input[name="location"]').on('keydown', (e) => {
        const key = e.which;

        // the enter key code
        if(key == 13) {
            const value = e.target.value
            locationsValue.push(value)
            const containerBadgeLocation = $('#container-badge-location')

            // check if container doesnt exist
            if (!containerBadgeLocation.length) {
                const container = document.createElement('div')
                container.className = 'd-flex flex-wrap gap-2'

                container.id = 'container-badge-location'
                container.innerHTML = `
                    <div class="badge-location">
                        <span>${value}</span>
                        <a href="#" id="location-delete" data-value="${value}">x</a>
                    </div>
                `
                $('#content-filter-location').append(container)
            } else {
                containerBadgeLocation.append(`
                    <div class="badge-location">
                        <span>${value}</span>
                        <a href="#" id="location-delete" data-value="${value}">x</a>
                    </div>
                `)
            }
            
            onDeleteLocation()
            e.target.value = ''
        }
    });

    /**
     * @description handle delete/remove location badge
     */
    const onDeleteLocation = () => {
        document.querySelectorAll('#location-delete').forEach(el => {
            el.addEventListener('click', (currentEl) => {
                currentEl.preventDefault();
                // get current value
                const getValue = currentEl.target.attributes['data-value'].value
                
                // remove data from variable
                const removeLocation = locationsValue.filter(item => item.toLowerCase() !== getValue.toLowerCase())
                locationsValue = removeLocation

                // remove element
                $(`a[data-value="${getValue}"]`).parent().remove()

                // if locations value is empty
                // then remove element container badge location
                if (locationsValue.length === 0) {
                    $('#container-badge-location').remove()
                }
            })
        })
    }

    /**
     * @description handle save filter
     */
    $('#btn-filter-save').on('click', function() {
        $('#table-lead-search').toggle()
        $('#card-empty-search').toggle()
    })
   })();
 });
 