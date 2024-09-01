/**
 * App Chat
 */

 'use strict';

 document.addEventListener('DOMContentLoaded', function () {
   (async function () {
    // variable form filters
    let locationsValue = [];
    let checkedLead = [];
    let industryValue = [];

    // variable global
    let customers = [];
    let tempSearchCustomerResult;

    const token = $("meta[name='csrf-token']").attr("content")

    $(".select2-industry").select2();

    // fetch lead generation list
    const fetchingLeadList = () => {
        fetch(`${baseUrl}api/lead-generation-list`, {
            headers: {
              'X-CSRF-TOKEN': token
            }
        })
        .then(r => r.json())
        .then(res => {
          if (res.result && Array.isArray(res.result) && res.result.length > 0) {
            res.result.forEach(item => {
                const el = document.createElement('h6')
                el.innerText = item.name
                el.style.color = '#1F2124'
                el.style.cursor = 'pointer'
                el.setAttribute('data-search-term', item.name)
                el.setAttribute('data-id', item.id)
                el.setAttribute('data-bs-toggle', 'modal')
                el.setAttribute('data-bs-target', '#confirmation')
                el.setAttribute('data-bs-dismiss', 'modal')
                el.className = 'lead-list'

                $('#lead-list-wrapper').append(el)
            })
            onClickAssignCustomer()
          } else {
            const el = document.createElement('span')
            el.innerText = 'No data list'

            $('#lead-list-wrapper').append(el)
          }
        })
    }

    fetchingLeadList()

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
     * @description render group age based on customer age
     */
    const renderGroupAge = (age) => {
        if (!age) return '-'
        if (typeof age === 'number') {
            let text;

            switch (true) {
                case age < 21:
                    text = 'Above - 21 years old'
                    break;
                case age >= 21 && age <= 29:
                    text = '21 - 29 years old'
                    break;
                case age >= 30 && age <= 39:
                    text = '30 - 39 years old'
                    break;
                case age >= 40 && age <= 49:
                    text = '40 - 49 years old'
                    break;
                default:
                    text = '50 years old - over'
                    break;
            }
            return text
        }
    }

    /**
     * @description render income level based on customer income level
     */
     const renderIncomeLevel = (income) => {
        if (!income) return '-'
        if (typeof income === 'string') {
            let text;

            switch (true) {
                case income === 'a':
                    text = 'Type A'
                    break;
                case income === 'b':
                    text = 'Type B'
                    break;
                case income === 'c':
                    text = 'Type C'
                    break;
                default:
                    text = 'Uncategorized'
                    break;
            }
            return text
        }
    }

    /**
     * handle truncate string text
     * @param {String} str 
     * @param {Number} offset 
     * @returns String
     */
    const truncateString = (str, offset = 10) => {
        if (!str) return ''
        if (typeof str === 'string') {
            if (str.length >= offset) {
                return str.slice(0, offset) + '...'
            } else {
                return str
            }
        }
    }

    /**
     * @description render modal confirmation with content
     * @param {Enum} 'confirmation' | 'success' | 'error' 
     * @param {String} subtitle
     * @param {Boolean} isHideBtnSubmit
     */
    const renderModalConfirmation = ({ type = 'confirmation', subtitle, isHideBtnSubmit = false }) => {
        const modalConfirmation = $('#confirmation')
        const btnSubmit = modalConfirmation.find('#modal-confirm-submit')
        const btnCancel = modalConfirmation.find('#modal-confirm-cancel')
        const modalTitle = modalConfirmation.find('#modal-body-title')
        const modalSubtitle = modalConfirmation.find('#modal-body-subtitle')

        switch (type.toLowerCase()) {
            case 'confirmation':
                modalTitle.text('Confirmation')
                modalSubtitle.text(subtitle)
                modalConfirmation.find('#modal-body-icon').html(`<img class="text-dark" src="assets/svg/icons/info-dark.svg" alt="info" width="100">`)
                btnCancel.addClass('btn')
                btnCancel.text('Cancel')

                if (isHideBtnSubmit) {
                    btnSubmit.removeClass('btn')
                    btnSubmit.hide()
                } else {
                    btnSubmit.text('Save')
                    btnSubmit.addClass('btn')
                    btnSubmit.show()
                }
                break;
            case 'success':
                modalTitle.text('Success!')
                modalSubtitle.text(subtitle)
                modalConfirmation.find('#modal-body-icon').html('<i class="ti ti-circle-check text-dark" style="font-size: 92px;"></i>')
                btnSubmit.removeClass('btn')
                btnSubmit.hide()
                btnCancel.text('Back')
                break;
            case 'error':
                modalTitle.text('Error!')
                modalSubtitle.text(subtitle)
                modalConfirmation.find('#modal-body-icon').html('<i class="ti ti-xbox-x text-dark" style="font-size: 92px;"></i>')
                btnSubmit.removeClass('btn')
                btnSubmit.hide()
                btnCancel.text('Back')
                break;
            default:
                break;
        }
    }

    /**
     * @description fetch create assign customer to list
     */
    const onClickAssignCustomer = () => {
        $('.lead-list').each(function() {
            $(this).on('click', function() {
                let customerNotJoin = []
                const formData = new FormData()
                const getListId = $(this).attr('data-id')
                const modalConfirmation = $('#confirmation')
                const btnSubmit = modalConfirmation.find('#modal-confirm-submit')
                const btnCancel = modalConfirmation.find('#modal-confirm-cancel')

                const getCustomerData = tempSearchCustomerResult.filter(cust => customers.includes(cust.id)).map(cust => ({
                    ...cust,
                    lists: cust.lists?.map(list => list.id)
                }))
                const getCustomerAlreadyJoinTeam = getCustomerData.filter(cust => {
                    if (cust.lists.length > 0 && cust.lists.includes(parseInt(getListId))) {
                        return cust
                    } else {
                        customerNotJoin.push(cust)
                    }
                })

                if (getCustomerAlreadyJoinTeam.length > 0) {
                    if (getCustomerAlreadyJoinTeam.length === 1 && customerNotJoin.length === 0) {
                        // check if single assign customer
                        // and customer already join
                        renderModalConfirmation({
                            type: 'confirmation',
                            subtitle: 'This customer already joined',
                            isHideBtnSubmit: true
                        })
                    } else if (customerNotJoin.length === 0) {
                        // check if bulk assign customer
                        // and all customers already join 
                        renderModalConfirmation({
                            type: 'confirmation',
                            subtitle: 'All customers already joined',
                            isHideBtnSubmit: true
                        })
                    } else {
                        renderModalConfirmation({
                            type: 'confirmation',
                            subtitle: `${getCustomerAlreadyJoinTeam.length} out of ${getCustomerData.length} customers already joined`
                        })
                    }
                }

                btnSubmit.on('click', function() {
                    // set btn loader
                    btnSubmit.html('<i class="ti ti-loader-2 loader"></i>')
                    btnCancel.html('<i class="ti ti-loader-2 loader"></i>')

                    customerNotJoin.forEach((cust, custIndex) => {
                        formData.append(`customers[${custIndex}]`, cust.id)
                    })
                    formData.append('list_id', getListId)

                    fetch(`${baseUrl}api/lead-generation/assign-customer`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                          'X-CSRF-TOKEN': token
                        }
                    })
                    .then(r => r.json())
                    .then(res => {
                        // change content modal confirmation to success
                        renderModalConfirmation({
                            type: 'success',
                            subtitle: 'Assign customers successfully'
                        })
                        // reset customers
                        customers = []
                        customerNotJoin = []
                    })
                    .catch(err => {
                        // change content modal confirmation to error
                        renderModalConfirmation({
                            type: 'error',
                            subtitle: 'Internal server error'
                        })
                        console.error(err)
                    })
                })
            })
        })
    }

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
    $('#filter-industry').on('click', function() {
        const content = $('#content-filter-industry')
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
    * @description handle add button list
    */
    const onClickButtonListAdd = () => {
        $('.btn-add-list').each(function() {
            $(this).on('click', function(el) {
                el.stopPropagation();
                customers.push(parseInt($(this).attr('customer-id')))
            })
        })
    }

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
                    <td class="dt-checkboxes-cell">
                        <input type="checkbox" class="dt-checkboxes form-check-input" customer-id="${val.id}">
                    </td>
                    <td data-bs-toggle="modal" data-bs-target="#detail-customer" data-id="${val.id}">
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">${getInitials(val.customer_name)}</span></div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate" style="color: #101828;">${val.customer_name}</span>
                          <span class="emp_name text-truncate">${truncateString(val.job_title, 20)}</span>
                        </div>
                      </div>
                    </td>
                    <td data-bs-toggle="modal" data-bs-target="#detail-customer" data-id="${val.id}">+62 xxx-xxx-xxx</td>
                    <td data-bs-toggle="modal" data-bs-target="#detail-customer" data-id="${val.id}">${val.location}</td>
                    <td>
                      <button
                        class="btn-add-list"
                        data-bs-toggle="modal"
                        data-bs-target="#list"
                        customer-id="${val.id}"
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
                    <td class="dt-checkboxes-cell">
                        <input type="checkbox" class="dt-checkboxes form-check-input" customer-id="${val.id}">
                    </td>
                    <td data-bs-toggle="modal" data-bs-target="#detail-customer" data-id="${val.id}">
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">${getInitials(val.customer_name)}</span></div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate" style="color: #101828;">${val.customer_name}</span>
                          <span class="emp_name text-truncate">${truncateString(val.job_title, 20)}</span>
                        </div>
                      </div>
                    </td>
                    <td data-bs-toggle="modal" data-bs-target="#detail-customer" data-id="${val.id}">+62 xxx-xxx-xxx</td>
                    <td data-bs-toggle="modal" data-bs-target="#detail-customer" data-id="${val.id}">${val.location}</td>
                    <td>
                      <button
                        class="btn-add-list"
                        data-bs-toggle="modal"
                        data-bs-target="#list"
                        customer-id="${val.id}"
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
            onClickButtonListAdd()
        }
    }

    /**
     * @description handle save filter
     */
    $('#btn-filter-save').on('click', function(e) {
        e.preventDefault()
        $('#card-empty-search').hide()
        $('#search-loader').show()
        $('#table-lead-search').hide()

        // reset tbody table
        $('#table-lead-search').find('tbody').empty()
    
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
            } else if (field.value !== '' && field.name !== 'industry') {
                payload.set(field.name, field.value)
            }

            if (field.name === 'industry') {
                industryValue.push(field.value)
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
        if (industryValue.length > 0) {
            payload.set('industry', industryValue)
        }

        fetch(`${baseUrl}api/lead-generation/search-customer?` + new URLSearchParams(payload), {
            headers: {
              'X-CSRF-TOKEN': token
            }
        })
        .then(r => r.json())
        .then(res => {
          $('#search-loader').hide()
          $('#table-lead-search').show()

          tempSearchCustomerResult = res.result
          renderChildTable(res.result)
          $('#table-lead-search').find('#table-header-title').text(`${res.result.length} match your filters`)
          // fetching detail customer
          fetchingDetailCustomer()

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
                      // adding current customer to global variable customers
                      customers.push(parseInt($(this).attr('customer-id')))
                  } else {
                      $(this).prop('checked', false)
                      checkedLead = checkedLead.map((item, itemIndex) => {
                        if (itemIndex === index) {
                            return false
                        }
                        return item
                      })
                      // takeout current customer in global variable customers
                      customers = customers.filter(cust => cust !== parseInt($(this).attr('customer-id')))
                  }
                  
                  // check if atleast one checkbox is checked
                  const isChecked = checkedLead.some(item => item)
                  if (!isChecked) {
                      $('#btn-header').attr('disabled', true)
                  }
              })
          })
        })

        // handle change checkbox select all
        $('.dt-checkboxes-select-all').on('change', function(e) {
            if (e.target.checked) {
                // reset global variable customers
                customers = []

                $('.dt-checkboxes').each(function() {
                    $(this).prop('checked', true)
                })
                $('#btn-header').attr('disabled', false)
                // adding all customer to global variable customers
                const customersId = tempSearchCustomerResult.map(cust => cust.id)
                customers = customersId
            } else {
                $('.dt-checkboxes').each(function() {
                    $(this).prop('checked', false)
                })
                $('#btn-header').attr('disabled', true)
                // reset global variable customers
                customers = []
            }
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

    /**
     * @description handle search lead generation list by name
     */
    $('#search-list-name').on('input', function(e) {
        const searchValue = e.target.value.toLowerCase()
        $('.lead-list').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1)
        });
    })


    /**
     * @description handle prevent default form create list
     */
    $('#form-create-list').on('submit', function(e) {
        e.preventDefault();
    })

    /**
     * @description handle submit form create list
     */
    $('#btn-create-list').on('click', function(e) {
        e.preventDefault()

        // btn loader
        $(this).html('<i class="ti ti-loader-2 loader"></i>')
    
        const payload = new FormData()
        $.each($('#form-create-list').serializeArray(), function(i, field) {
            payload.set(field.name, field.value)
        })

        fetch(`${baseUrl}api/lead-generation-list`, {
            method: 'POST',
            body: payload,
            headers: {
              'X-CSRF-TOKEN': token
            }
        })
        .then(res => {
            if (res.status === 200) {
                $(this).html('Save')
                $('#lead-list-wrapper').empty()
                $("#add-list").find(`[data-bs-target='#list']`).click()
                fetchingLeadList()
                renderModalConfirmation({
                    type: 'success',
                    subtitle: 'Created list successfully'
                })

                // set attribute btn cancel modal confirmation
                // open modal list
                const btnCancel = $('#confirmation').find('#modal-confirm-cancel')
                btnCancel.attr('data-bs-target', '#list')
                btnCancel.attr('data-bs-toggle', 'modal')

                btnCancel.on('click', function() {
                    // remove attribute btn cancel modal confirmation
                    btnCancel.removeAttr('data-bs-target')
                    btnCancel.removeAttr('data-bs-toggle')
                })
            }
        })
        .catch(err => {
            $(this).html('Save')
            renderModalConfirmation({
                type: 'error',
                subtitle: 'Internal server error'
            })
            console.error(err)
        })
    })

    /**
     * @description handle fetch detail customer on modal detail customer
     */
    const fetchingDetailCustomer = () => {
        $('#table-lead-search').find(`[data-bs-target='#detail-customer']`).each(function() {
            $(this).on('click', function() {
                const getCustomerId = $(this).attr('data-id')
                fetch(`${baseUrl}api/lead-generation/${getCustomerId}`, {
                    headers: {
                      'X-CSRF-TOKEN': token
                    }
                })
                .then(r => r.json())
                .then(res => {
                    const data = res.data
                    // find element modal
                    const targetModal = $('#detail-customer').find('.modal-body')
                    targetModal.html(`
                    <div class="gap-3 container-lead-search-detail">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between">
                              <div class="d-flex align-items-center gap-3">
                                <div class="flex-shrink-0 avatar" style="width: 110px; height: 110px;">
                                  <span class="avatar-initial rounded-circle text-dark fw-bolder fs-1">${getInitials(data.customer_name)}</span>
                                </div>
                                <div class="d-flex flex-column justify-content-between gap-3">
                                  <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center gap-2">
                                      <span style="font-size: 24px;" class="text-dark fw-bold">${data.customer_name}</span>
                                      <img src="assets/svg/icons/icon-verify.svg" alt="verify account">
                                    </div>
                                    <span class="text-dark fw-bold">${data.job_title}</span>
                                  </div>
                                  <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-1">
                                      <i class="ti ti-user"></i>
                                      <span>${data.gender},</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                      <span>${renderGroupAge(data.age)},</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                      <img src="assets/svg/icons/icon-dolar-outline.svg" alt="dolar">
                                      <span>${renderIncomeLevel(data.income_level?.toLowerCase())}</span>
                                    </div>
                                    <span>&#128900;</span>
                                    <div class="d-flex align-items-center gap-1">
                                      <span>${data.location}</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <i class="ti ti-x" data-bs-dismiss="modal" data-bs-target="#detail-customer" style="cursor: pointer;"></i>
                            </div>
                            <div class="card-contact-info d-flex flex-column gap-3">
                              <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark fw-bolder" style="font-size: 18px;">Contact Information</span>
                                <button
                                  class="btn-add-list"
                                  data-bs-toggle="modal"
                                  data-bs-target="#list"
                                  customer-id="${data.id}"
                                >
                                  <i class="ti ti-plus"></i>
                                  Add to list
                                </button>
                              </div>
                              <div class="contact-info-content">
                                <div class="d-flex align-items-center gap-2">
                                  <img src="assets/svg/icons/icon-whatsapp.svg" alt="wa">
                                  <span class="text-dark">+62 xxx-xxx-xxx</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                  <i class="ti ti-world"></i>
                                  <a target="_blank" href="${data?.url ?? '#'}" class="text-dark">
                                    ${data?.url ?? '-'}
                                  </a>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                  <i class="ti ti-mail"></i>
                                  <span class="text-dark">${data?.email ?? '-'}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                  <span>Social: </span>
                                  <a target="_blank" href="${data?.linkedin ?? '#'}">
                                    <img src="assets/svg/icons/icon-linkedin.svg" alt="linkedin">
                                  </a>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    `)
                    $('#detail-customer').find(`.ti-x`).on('click', function() {
                        targetModal.html(`
                        <div class="d-flex justify-content-center">
                            <i
                              class="ti ti-x"
                              data-bs-dismiss="modal"
                              data-bs-target="#detail-customer"
                              style="cursor: pointer; position: absolute; right: 0; margin-right: 20px;"
                            >
                            </i>
                            <div class="spinner-border text-primary" role="status">
                              <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        `)
                    })
                    onClickButtonListAdd()
                }).catch(err => console.error(err))
            })
        })
    }
   })();
 });
 