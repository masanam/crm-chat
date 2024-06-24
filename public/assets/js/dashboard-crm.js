'use-strict';

document.addEventListener('DOMContentLoaded', function () {
    (function () {          
        const dropArea = document.querySelector('#drop-area');
        const inputElement = document.querySelector('#file');

        function preventDefaults (e) {
            e.preventDefault();
            e.stopPropagation();
        };

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea?.addEventListener(eventName, preventDefaults, false);
        });

        /**
         * @description handle upload file
         * @param {File} file 
         */
        const uploadFile = file => {
            if (!file) return console.error('file must required!')

            const getElementFilename = document.querySelector('#result-filename')
            if (getElementFilename) {
                getElementFilename.innerHTML = file.name
            } else {
                const filenameElement = document.createElement("span")
                filenameElement.setAttribute('id', 'result-filename')
                filenameElement.classList.add('text-sm')
                filenameElement.innerHTML = file.name
                dropArea.appendChild(filenameElement)
            }
        }

        /**
         * @description handle change file
         */
        inputElement?.addEventListener('change', (e) => {
            let { files } = e.target
            let getFile = files[0]

            uploadFile(getFile)
        })

        /**
         * @description handle open upload file in drop zone
         */
        dropArea?.addEventListener('click', () => {
            inputElement.click();
        });

        dropArea?.addEventListener('dragenter', () => {
            dropArea.classList.add('highlight');
        });

        dropArea?.addEventListener('dragleave', () => {
            dropArea.classList.remove('highlight');
        });

        dropArea?.addEventListener('dragover', () => {
            dropArea.classList.add('highlight');
        });

        /**
         * @description handle drop file
         */
        dropArea?.addEventListener('drop', (e) => {
            dropArea.classList.remove('highlight');
            let dt = e.dataTransfer
            let getFile = dt.files[0]

            uploadFile(getFile)
        });
        
        /**
         * @description handle logic adding class active in component card payment method
         */
        const getElementPaymentMethod = document.querySelectorAll('.card-payment-method')
        getElementPaymentMethod.forEach((parentEl) => {
            parentEl?.addEventListener('change', () => {
                getElementPaymentMethod.forEach(el => {
                    el.classList.remove('active')
                })
                parentEl.classList.add('active')
            })
        })

        /**
         * @description remove class modal backdrop if modal is stack in modal payment method
         */
        const getModalPaymentMethod = document.querySelector('#add-payment-method')
        getModalPaymentMethod?.addEventListener('click', (e) => {
            const getElementModalBackdropAll = document.querySelectorAll('.modal-backdrop')
            if (e.target === e.currentTarget) {
                getElementModalBackdropAll.forEach(el => el.remove())
            }
        })

        /**
         * @description handle add/remove class active custom select cloud api
         */
        const formSelectApi = document.querySelector('#custom-select')
        formSelectApi?.addEventListener('click', () => {
            if (formSelectApi.classList.contains('active')) {
                formSelectApi.classList.remove('active')
            } else {
                formSelectApi.classList.add('active')
            }
        })

        /**
         * @description flow open/close picker date
         */
        const bsPickrDate = $("#bs-datepicker");
        const bsPickrDateTo = $("#bs-datepicker-to");
        if (bsPickrDate.length) {
            bsPickrDate.daterangepicker({
                autoUpdateInput: false,
                opens: 'left'
            });
            bsPickrDate.on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY'));
                bsPickrDateTo.val(picker.endDate.format('MM/DD/YYYY'));
            });
            bsPickrDate.on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });  
        }

        /**
         * @description handle tab billing
         */
        const navLink = document.querySelectorAll('.nav-link');
        const getWrapper = document.querySelector('.dashboard-crm-content')
        const tabContentWrapper = document.querySelector('#tab-content-wrapper')
        const tabContentBillingWrapper = document.querySelector('.tab-billing-content')
        const tabUsage = document.querySelector('.tab-usage')
        const tabPaymentMethod = document.querySelector('.tab-payment-method')
        const navParent = document.querySelector('.nav-parent')
        const navTabsBilling = document.querySelector('#nav-tabs-billing')

        const applyStyling = () => {
            getWrapper.style.padding = '1.875rem 0'
            tabContentWrapper.style.padding = '1.5rem 0'
            navParent.style.padding = '0 1.875rem'
        }

        navLink.forEach(el => {
            el?.addEventListener('click', () => {
                switch (el.getAttribute('data-bs-target')) {
                    case '#billing':
                        applyStyling()
                        tabContentBillingWrapper.style.padding = '1.5rem 3.5rem'
                        tabUsage.classList.add('hidden')
                        navTabsBilling.style.padding = '0 1.8rem'
                        break;
                    case '#usage':
                        applyStyling()
                        tabContentBillingWrapper.style.padding = '1.5rem 1.8rem'
                        tabUsage.classList.remove('hidden')
                        tabPaymentMethod.classList.add('hidden')
                        break;
                    case '#payment-method':
                        applyStyling()
                        tabContentBillingWrapper.style.padding = '1.5rem 3.5rem'
                        tabPaymentMethod.classList.remove('hidden')
                        tabUsage.classList.add('hidden')
                        break;
                    default:
                        getWrapper.style.padding = '1.875rem'
                        tabContentWrapper.style.padding = '1.5rem'
                        navParent.style.padding = '0'
                        break;
                }
            })
        })

        // chart
        let cardColor, labelColor, headingColor, borderColor, legendColor, cyanColor, isRtl;
        cyanColor = '#33B6B9';
        cardColor = config.colors.cardColor;
        headingColor = config.colors.headingColor;
        labelColor = config.colors.textMuted;
        legendColor = config.colors.bodyColor;
        borderColor = config.colors.borderColor;
        isRtl = true;

        const activitiesChart = document.getElementById('activitiesChart');
        const activitiesChart2 = document.getElementById('activitiesChart2');
        const closeByUserChart = document.getElementById('closeByUserChart');
        const wonByUserChart = document.getElementById('wonByUserChart');

        if (activitiesChart) {
            new Chart(activitiesChart, {
              type: 'bar',
              data: {
                labels: [
                  'Jan',
                  'Mar',
                  'May',
                  'Jul',
                  'Sep',
                  'Nov',
                  'Dec',
                ],
                datasets: [
                  {
                    data: [275, 90, 190, 205, 125, 85, 55],
                    backgroundColor: cyanColor,
                    borderColor: 'transparent',
                    maxBarThickness: 15,
                    borderRadius: {
                      topRight: 15,
                      topLeft: 15
                    }
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                  duration: 500
                },
                plugins: {
                  tooltip: {
                    rtl: isRtl,
                    backgroundColor: cardColor,
                    titleColor: headingColor,
                    bodyColor: legendColor,
                    borderWidth: 1,
                    borderColor: borderColor
                  },
                  legend: {
                    display: false
                  }
                },
                scales: {
                  x: {
                    grid: {
                      color: borderColor,
                      drawBorder: false,
                      borderColor: borderColor
                    },
                    ticks: {
                      color: labelColor
                    }
                  },
                  y: {
                    min: 0,
                    max: 1000,
                    grid: {
                      color: borderColor,
                      drawBorder: false,
                      borderColor: borderColor
                    },
                    ticks: {
                      stepSize: 100,
                      color: labelColor
                    }
                  }
                }
              }
            });
        }

        if (activitiesChart2) {
            new Chart(activitiesChart2, {
              type: 'bar',
              data: {
                labels: [
                  'Jan',
                  'Mar',
                  'May',
                  'Jul',
                  'Sep',
                  'Nov',
                  'Dec',
                ],
                datasets: [
                  {
                    data: [275, 90, 190, 205, 125, 85, 55],
                    backgroundColor: cyanColor,
                    borderColor: 'transparent',
                    maxBarThickness: 15,
                    borderRadius: {
                      topRight: 15,
                      topLeft: 15
                    }
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                  duration: 500
                },
                plugins: {
                  tooltip: {
                    rtl: isRtl,
                    backgroundColor: cardColor,
                    titleColor: headingColor,
                    bodyColor: legendColor,
                    borderWidth: 1,
                    borderColor: borderColor
                  },
                  legend: {
                    display: false
                  }
                },
                scales: {
                  x: {
                    grid: {
                      color: borderColor,
                      drawBorder: false,
                      borderColor: borderColor
                    },
                    ticks: {
                      color: labelColor
                    }
                  },
                  y: {
                    min: 0,
                    max: 1000,
                    grid: {
                      color: borderColor,
                      drawBorder: false,
                      borderColor: borderColor
                    },
                    ticks: {
                      stepSize: 100,
                      color: labelColor
                    }
                  }
                }
              }
            });
        }

        if (closeByUserChart) {
            new Chart(closeByUserChart, {
              type: 'bar',
              data: {
                labels: [
                  'Jan',
                  'Mar',
                  'May',
                  'Jul',
                  'Sep',
                  'Nov',
                  'Dec',
                ],
                datasets: [
                  {
                    label: 'Leads',
                    data: [275, 90, 190, 205, 125, 85, 55],
                    backgroundColor: cyanColor,
                    borderColor: 'transparent',
                    maxBarThickness: 15,
                    borderRadius: {
                      topRight: 50,
                      topLeft: 50
                    },
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                  duration: 500
                },
                plugins: {
                  tooltip: {
                    rtl: isRtl,
                    backgroundColor: cardColor,
                    titleColor: headingColor,
                    bodyColor: legendColor,
                    borderWidth: 1,
                    borderColor: borderColor
                  },
                  legend: {
                    position: 'bottom',
                    align: 'start',
                    display: true,
                    labels: {
                      usePointStyle: true,
                      boxWidth: 22,
                    }
                  },
                },
                scales: {
                  x: {
                    grid: {
                      display: false
                    },
                    ticks: {
                      color: labelColor
                    }
                  },
                  y: {
                    title: {
                      display: true,
                      text: 'Active users'
                    },
                    min: 0,
                    max: 1000,
                    grid: {
                      color: borderColor,
                      drawBorder: false,
                      borderColor: borderColor
                    },
                    ticks: {
                      stepSize: 100,
                      color: labelColor
                    }
                  }
                }
              }
            });
        }

        if (wonByUserChart) {
            new Chart(wonByUserChart, {
              type: 'doughnut',
              data: {
                labels: ['Leads', 'Test'],
                datasets: [
                  {
                    label: 'Leads',
                    data: [10, 50],
                    backgroundColor: [cyanColor, '#CCE8E8'],
                    borderColor: 'transparent',
                    borderWidth: 0,
                    pointStyle: 'rectRounded'
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                  duration: 500
                },
                cutout: '68%',
                plugins: {
                  legend: {
                    position: 'right',
                    align: 'center',
                    display: true,
                    labels: {
                      usePointStyle: true,
                      boxWidth: 22,
                    }
                  },
                  tooltip: {
                    callbacks: {
                      label: function (context) {
                        const label = context.labels || '',
                          value = context.parsed;
                        const output = ' ' + label + ' : ' + value + ' %';
                        return output;
                      }
                    },
                    // Updated default tooltip UI
                    rtl: isRtl,
                    backgroundColor: cardColor,
                    titleColor: headingColor,
                    bodyColor: legendColor,
                    borderWidth: 1,
                    borderColor: borderColor
                  }
                }
              }
            });
        }
    })();
});
