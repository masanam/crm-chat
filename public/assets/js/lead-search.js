/**
 * App Chat
 */

 'use strict';

 document.addEventListener('DOMContentLoaded', function () {
   (async function () {
    // variable form filters
    let locationsValue = [];
    let checkedLead = [];

    /**
    * get initial name
    */
    const getInitials = function (string) {
        var names = string.split(' '),
            initials = names[0].substring(0, 1).toUpperCase();
        
        if (names.length > 1) {
            initials += names[names.length - 1].substring(0, 1).toUpperCase();
        }
        return initials;
    };

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
    $('input[name="customer_name"]').on('focus', () => {
        $('.btn-search').css({ top: '65px' })
    })
    $('input[name="customer_name"]').on('focusout', () => {
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
     * @description handle event click field gender
     */
    $('select[name="gender"]').on('click', (e) => {
        e.stopPropagation();
    })

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

    $('#form-search').on('submit', function(e) {
        e.preventDefault();
    })

    /**
     * @description render child table search customer
     * @param {Array} data
     */
    const renderChildTable = (data) => {
        if (!data) return console.error('data not found!')

        const tbody = $('#table-lead-search').find('tbody')
        if (data && Array.isArray(data)) {
            data.forEach((val, valIndex) => {
                const elementTr = document.createElement('tr')

                if (valIndex % 2 === 0) {
                    elementTr.innerHTML = `
                        <tr class="odd">
                    <td class="control" style="display: none;" tabindex="0"></td>
                    <td class="dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
                    <td data-bs-toggle="modal" data-bs-target="#detail-customer">
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">${getInitials(val.customer_name)}</span></div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate" style="color: #101828;">${val.customer_name}</span>
                          <span class="emp_name text-truncate">CEO</span>
                        </div>
                      </div>
                    </td>
                    <td data-bs-toggle="modal" data-bs-target="#detail-customer">+62 xxx-xxx-xxx</td>
                    <td data-bs-toggle="modal" data-bs-target="#detail-customer">${val.location}</td>
                    <td>
                      <button
                        class="btn-add-list"
                        data-bs-toggle="modal"
                        data-bs-target="#list"
                      >
                        <i class="ti ti-plus"></i>
                        Add to list
                      </button>
                    </td>
                  </tr>
                  `
                } else {
                    elementTr.innerHTML = `
                    <tr class="even">
                    <td class="control" style="display: none;" tabindex="0"></td>
                    <td class="dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
                    <td data-bs-toggle="modal" data-bs-target="#detail-customer">
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">${getInitials(val.customer_name)}</span></div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate" style="color: #101828;">${val.customer_name}</span>
                          <span class="emp_name text-truncate">CEO</span>
                        </div>
                      </div>
                    </td>
                    <td data-bs-toggle="modal" data-bs-target="#detail-customer">+62 xxx-xxx-xxx</td>
                    <td data-bs-toggle="modal" data-bs-target="#detail-customer">${val.location}</td>
                    <td>
                      <button
                        class="btn-add-list"
                        data-bs-toggle="modal"
                        data-bs-target="#list"
                      >
                        <i class="ti ti-plus"></i>
                        Add to list
                      </button>
                    </td>
                  </tr>
                    `
                }

                tbody.append(elementTr)
            })
        }
    }

    /**
     * @description handle save filter
     */
    $('#btn-filter-save').on('click', function(e) {
        e.preventDefault()
        // reset tbody table
        $('#table-lead-search').find('tbody').empty()
        
        const token = $("meta[name='csrf-token']").attr("content")
        const payload = new FormData()
        const age = []
        const incomeLevel = []

        $.each($('#form-search').serializeArray(), function(i, field) {
            if (field.name.includes('age')) {
                const ages = field.value.split('-')
                ages.forEach(val => {
                    age.push(parseInt(val))
                })
            } else if (field.name.includes('income_level')) {
                incomeLevel.push(field.value)
            } else if (field.value !== '') {
                payload.set(field.name, field.value)
            }
        })

        if (locationsValue.length > 0) {
            payload.set('location', locationsValue)
        }
        if (age.length > 0) {
            payload.set('income_level', incomeLevel)
        }
        if (age.length > 0) {
            payload.set('min_age', Math.min(...age))
            payload.set('max_age', Math.max(...age))
        }

        fetch(`${baseUrl}api/lead-generation/search-customer?` + new URLSearchParams(payload), {
            headers: {
              'X-CSRF-TOKEN': token
            }
        })
        .then(r => r.json())
        .then(res => {
          renderChildTable(res.result)
          $('#table-lead-search').find('#table-header-title').text(`${res.result.length} match your filters`)
        })

        $('#table-lead-search').css({ display: 'block' })
        $('#card-empty-search').css({ display: 'none' })

        // handle change checkbox select all
        $('.dt-checkboxes-select-all').on('change', function(e) {
            if (e.target.checked) {
                $('.dt-checkboxes').each(function() {
                    $(this).prop('checked', true)
                })
                $('#btn-header').attr('disabled', false)
            } else {
                $('.dt-checkboxes').each(function() {
                    $(this).prop('checked', false)
                })
                $('#btn-header').attr('disabled', true)
            }
        })

        // handle change value checkbox
        $('.dt-checkboxes').each(function(index) {
            checkedLead.push($(this).prop('checked'))

            $(this).on('change', function(e) {
                if (e.target.checked) {
                    $(this).prop('checked', true)
                    $('#btn-header').attr('disabled', false)
                    checkedLead = checkedLead.map((item, itemIndex) => {
                        if (itemIndex === index) {
                            return true
                        }
                        return item
                    })
                } else {
                    $(this).prop('checked', false)
                    checkedLead = checkedLead.map((item, itemIndex) => {
                        if (itemIndex === index) {
                            return false
                        }
                        return item
                    })
                }
                
                // check if atleast one checkbox is checked
                const isChecked = checkedLead.some(item => item)
                if (!isChecked) {
                    $('#btn-header').attr('disabled', true)
                }
            })
        })
    })

    /**
     * @description handle add button list
     */
    $('.btn-add-list').each(function() {
        $(this).on('click', function(el) {
            el.stopPropagation();
        })
    })

    $('.nav-link').each(function() {
        $(this).on('click', function() {
            switch ($(this).attr('data-bs-target')) {
                case '#experience':
                    $('#experience').show();
                    $('#experience').addClass('d-flex flex-column');
                    $('#signals').hide();
                    $('#signals').removeClass('d-flex flex-column');
                    break;
            
                case '#signals':
                    $('#experience').hide();
                    $('#experience').removeClass('d-flex flex-column');
                    $('#signals').show();
                    $('#signals').addClass('d-flex flex-column');
                    break;
            }
        })
    })
   })();
 });
 