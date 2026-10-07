let isFullyLoaded = false;

document.documentElement.classList.add('menu-loading');

document.addEventListener('DOMContentLoaded', function () {

    // Add this new section at the start
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    // Prevent toggler interaction until DOM is fully ready
    if (navbarToggler && navbarCollapse) {
        // NEW:
        navbarToggler.disabled = true;
        const preventClick = (e) => {
            if (!isFullyLoaded) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
            }
        };
        navbarToggler.addEventListener('click', preventClick, true);
        navbarToggler.addEventListener('click', preventClick, false);
    }

    const megaMenuItems = document.querySelectorAll('.menu-item.has-mega');
    let isMobile = window.innerWidth < 992;

    /* ===============================
       HELPER
    =============================== */
    const resetGlobalState = () => {
        megaMenuItems.forEach(item => item.classList.remove('is-clicked'));
    };

    const resetMobileState = () => {
        megaMenuItems.forEach(item => {
            item.classList.remove('lvl-1-active');
        });
        document.querySelectorAll('.mega-center-content.active, .mega-right-content.active, .industry-panel.active').forEach(el => {
            el.classList.remove('active');
        });
        document.querySelectorAll('.mega-menu .mega-left .mega-left-item.active').forEach(el => {
            el.classList.remove('active');
        });
        
        // IMPORTANT: Restore original DOM structure for all menus
        restoreOriginalDOMStructure();
    };

    // Store original DOM structure on page load
    const originalDOMStructure = new Map();
    
    function storeOriginalDOMStructure() {
        document.querySelectorAll('.mega-menu').forEach(megaMenu => {
            const menuItem = megaMenu.closest('.menu-item');
            const menuId = menuItem.querySelector('a').textContent.trim();
            
            // Store center content elements
            const centerContents = Array.from(megaMenu.querySelectorAll('.mega-center-content'));
            const centerParent = megaMenu.querySelector('.mega-center');
            
            // Store right content elements
            const rightContents = Array.from(megaMenu.querySelectorAll('.mega-right-content'));
            const rightParent = megaMenu.querySelector('.mega-right');
            
            // Store industry panels
            const industryPanels = Array.from(megaMenu.querySelectorAll('.industry-panel'));
            const industryParent = megaMenu.querySelector('.industries-mega .mega-right');
            
            originalDOMStructure.set(menuId, {
                centerContents,
                centerParent,
                rightContents,
                rightParent,
                industryPanels,
                industryParent
            });
        });
    }
    
    function restoreOriginalDOMStructure() {
        originalDOMStructure.forEach((structure, menuId) => {
            // Restore center contents
            if (structure.centerParent && structure.centerContents.length > 0) {
                structure.centerContents.forEach(el => {
                    if (el.parentElement !== structure.centerParent) {
                        structure.centerParent.appendChild(el);
                    }
                });
            }
            
            // Restore right contents
            if (structure.rightParent && structure.rightContents.length > 0) {
                structure.rightContents.forEach(el => {
                    if (el.parentElement !== structure.rightParent) {
                        structure.rightParent.appendChild(el);
                    }
                });
            }
            
            // Restore industry panels
            if (structure.industryParent && structure.industryPanels.length > 0) {
                structure.industryPanels.forEach(el => {
                    if (el.parentElement !== structure.industryParent) {
                        structure.industryParent.appendChild(el);
                    }
                });
            }
        });
    }
    
    // Store the original structure on page load
    storeOriginalDOMStructure();

    /* ===============================
       RESIZE HANDLER - CRITICAL FIX
    =============================== */
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            const wasMobile = isMobile;
            isMobile = window.innerWidth < 992;

            // Only reset if we actually switched modes
            if (wasMobile !== isMobile) {
                // Reset both desktop and mobile states
                resetGlobalState();
                resetMobileState();
                
                // Hide mobile search results
                const mobileResults = document.querySelector('.mobile-search-results-wrapper');
                if (mobileResults) {
                    mobileResults.classList.remove('show');
                    mobileResults.innerHTML = '';
                }
                
                // Show navmenu if hidden
                const navmenu = document.querySelector('ul.navmenu');
                if (navmenu) navmenu.style.display = '';
                
                // Clear all search inputs
                document.querySelectorAll('.mega-menu-search-input').forEach(input => {
                    input.value = '';
                });
                
                // Restore all original content
                // CRITICAL: Ensure search bar is in correct position
                document.querySelectorAll('.mega-menu').forEach(megaMenu => {
                    const searchWrapper = megaMenu.querySelector('.mega-menu-search-wrapper');
                    const megaCenter = megaMenu.querySelector('.mega-center');
                    
                    // If search wrapper exists and mega-center exists
                    if (searchWrapper && megaCenter) {
                        // Make sure search wrapper is the LAST child of mega-center
                        if (megaCenter.lastElementChild !== searchWrapper) {
                            megaCenter.appendChild(searchWrapper);
                        }
                    }
                });

               // CRITICAL: Re-initialize mobile menu handlers after resize
                if (isMobile) {
                    // Small delay to ensure DOM is ready
                    setTimeout(() => {
                        initMobileMenu();
                    }, 100);
                } else {
                    // Reset locked targets for desktop menus
                    document.querySelectorAll('.menu-item.has-mega').forEach(menu => {
                        const firstLeftItem = menu.querySelector('.mega-left-item');
                        if (firstLeftItem) {
                            // Programmatically trigger the activation for ALL menus (whether open or not)
                            const targetId = firstLeftItem.dataset.target;
                            if (targetId) {
                                // Remove all active classes first
                                menu.querySelectorAll('.mega-left-item, .mega-center-content, .mega-right-content, .industry-panel').forEach(el => {
                                    el.classList.remove('active');
                                });
                                
                                // Add active class to first item
                                firstLeftItem.classList.add('active');
                                
                                // Check if this is industries mega menu
                                const isIndustriesMega = menu.classList.contains('industries-mega');
                                
                                if (isIndustriesMega) {
                                    // For industries mega menu
                                    const panel = menu.querySelector('#' + targetId);
                                    if (panel) panel.classList.add('active');
                                } else {
                                    // For regular mega menu (Services, Resources)
                                    const centerContent = menu.querySelector('#' + targetId);
                                    const rightContent = menu.querySelector('#' + targetId.replace('left-', 'right-'));
                                    
                                    if (centerContent) centerContent.classList.add('active');
                                    if (rightContent) rightContent.classList.add('active');
                                }
                            }
                        }
                    });
                }
            }
        }, 250);
    });

    /* ===============================
    1. MAIN MENU - CLICK ONLY (NO HOVER)
    =============================== */
    megaMenuItems.forEach(item => {
        const mainLink = item.querySelector('a');

        // CLICK ONLY - NO HOVER on desktop
        mainLink.addEventListener('click', e => {
            if (window.innerWidth >= 992) {
                e.preventDefault();
                e.stopPropagation();

                const already = item.classList.contains('is-clicked');
                resetGlobalState();
                if (!already) {
                    item.classList.add('is-clicked');
                    
                    // Activate first panel when menu opens
                    setTimeout(() => {
                        const firstLeftItem = item.querySelector('.mega-left-item');
                        if (firstLeftItem && !item.querySelector('.mega-left-item.active')) {
                            const targetId = firstLeftItem.dataset.target;
                            
                            // Remove all active classes
                            item.querySelectorAll('.mega-left-item, .mega-center-content, .mega-right-content, .industry-panel').forEach(el => {
                                el.classList.remove('active');
                            });
                            
                            // Add active to first item
                            firstLeftItem.classList.add('active');
                            
                            // Check if industries mega
                            const isIndustriesMega = item.classList.contains('industries-mega');
                            
                            if (isIndustriesMega) {
                                const panel = item.querySelector('#' + targetId);
                                if (panel) panel.classList.add('active');
                            } else {
                                const centerContent = item.querySelector('#' + targetId);
                                const rightContent = item.querySelector('#' + targetId.replace('left-', 'right-'));
                                
                                if (centerContent) centerContent.classList.add('active');
                                if (rightContent) rightContent.classList.add('active');
                            }
                        }
                    }, 50);
                }
            }
        });
    });
    
    document.addEventListener('click', e => {
    if (window.innerWidth < 992) return;  // Only works on desktop
    if (!e.target.closest('.menu-item.has-mega')) {
        resetGlobalState();
        
        // Also reset the active states for Industries mega menu
        document.querySelectorAll('.industries-mega .mega-left-item.active').forEach(item => {
            item.classList.remove('active');
        });
        document.querySelectorAll('.industries-mega .industry-panel.active').forEach(panel => {
            panel.classList.remove('active');
        });
    }
    });

    
    /* ===============================
    2. SERVICES MEGA (CLICK STAYS ACTIVE)
    =============================== */
    document.querySelectorAll(
        '.menu-item.has-mega:not(.industries-mega):not(.resource-mega)'
    ).forEach(menu => {
        let lockedTarget = null;

        const activate = (btn) => {
            const id = btn.dataset.target;
            if (!id) return;

            menu.querySelectorAll(
                '.mega-left-item, .mega-center-content, .mega-right-content'
            ).forEach(el => el.classList.remove('active'));

            btn.classList.add('active');
            menu.querySelector('#' + id)?.classList.add('active');
            menu.querySelector('#' + id.replace('left-', 'right-'))?.classList.add('active');
        };

        menu.querySelectorAll('.mega-left-item').forEach(btn => {
            const hasLink = btn.dataset.hasLink === 'true';
            const href = btn.getAttribute('href');

            btn.addEventListener('click', e => {
                // DESKTOP: Check if item has a real link
                if (window.innerWidth >= 992) {
                    // If item has a real link, allow navigation
                    if (hasLink && href !== '#') {
                        // Let the link work normally (redirect)
                        return;
                    }
                    
                    // Otherwise, activate the submenu
                    e.preventDefault();
                    e.stopPropagation();
                    lockedTarget = btn;
                    activate(btn);
                }
                // MOBILE: Links work normally, no preventDefault needed
            });

            btn.addEventListener('mouseenter', () => {
                if (window.innerWidth < 992) return;
                if (lockedTarget) return;

                // 🚫 STOP hover switching while searching
                const megaMenu = btn.closest('.mega-menu');
                const searchInput = megaMenu?.querySelector('.mega-menu-search-input');
                if (searchInput && searchInput.value.trim().length > 0) return;

                // Don't activate on hover if item has a link
                if (hasLink && href !== '#') return;

                activate(btn);
            });

        });

        // Reset locked target on menu close (desktop)
        menu.addEventListener('mouseleave', () => {
            if (window.innerWidth >= 992) {
                lockedTarget = null;
            }
        });
    });

    
    /* ===============================
    3. INDUSTRIES MEGA (CLICK STAYS ACTIVE)
    =============================== */
    document.querySelectorAll('.industries-mega').forEach(menu => {

        let lockedTarget = null;

        const activate = (btn) => {
            const target = btn.dataset.target;

            menu.querySelectorAll('.mega-left-item, .industry-panel')
                .forEach(el => el.classList.remove('active'));

            btn.classList.add('active');
            menu.querySelector('#' + target)?.classList.add('active');
        };

        menu.querySelectorAll('.mega-left-item').forEach(btn => {

            btn.addEventListener('click', e => {
                if (window.innerWidth < 992) return;

                // ✅ If real link exists → allow redirect
                if (hasLink && href && href !== '#') {
                    return;
                }
                
                e.preventDefault();
                e.stopPropagation();
                lockedTarget = btn;
                activate(btn);
            });

            btn.addEventListener('mouseenter', () => {
                if (window.innerWidth < 992) return;
                if (lockedTarget) return;
                activate(btn);
            });
        });

        // Reset locked target on menu close (desktop)
        menu.addEventListener('mouseleave', () => {
            if (window.innerWidth >= 992) {
                lockedTarget = null;
            }
        });
    });


    /* ===============================
       4. MOBILE (REFINED ACCORDION) - COMPLETE FIX
    =============================== */
    let mobileHandlersAttached = false;
    
    const initMobileMenu = () => {
        if (window.innerWidth >= 992) return;
        
        // Prevent duplicate initialization
        if (mobileHandlersAttached) return;
        mobileHandlersAttached = true;

        // Remove default active classes on mobile
        resetMobileState();

        megaMenuItems.forEach(item => {
            const topLevelLink = item.querySelector('a');
            
            // Create a new click handler
            const mobileClickHandler = function (e) {
                if (window.innerWidth >= 992) return;
                
                e.preventDefault();
                e.stopPropagation();

                const isOpen = item.classList.contains('lvl-1-active');

                // Close ALL other menus
                megaMenuItems.forEach(other => {
                    if (other !== item) {
                        other.classList.remove('lvl-1-active');
                        other.querySelectorAll('.mega-left-item, .mega-center-content, .mega-right-content, .industry-panel').forEach(el => {
                            el.classList.remove('active');
                        });
                    }
                });

                // Toggle current menu
                if (!isOpen) {
                    item.classList.add('lvl-1-active');
                } else {
                    item.classList.remove('lvl-1-active');
                    item.querySelectorAll('.mega-left-item, .mega-center-content, .mega-right-content, .industry-panel').forEach(el => {
                        el.classList.remove('active');
                    });
                }
            };
            
            // Store handler for potential cleanup
            topLevelLink._mobileClickHandler = mobileClickHandler;
            topLevelLink.addEventListener('click', mobileClickHandler);
        });

        // Handle sub-menu clicks
        document.querySelectorAll('.mega-left-item').forEach(item => {
            const mobileSubClickHandler = function (e) {
                if (window.innerWidth >= 992) return;
                
                const hasLink = this.dataset.hasLink === 'true';
                const href = this.getAttribute('href');
                
                // If item has a real link, allow navigation
                if (hasLink && href !== '#') {
                    // Let the link work normally (redirect)
                    return;
                }
                
                e.preventDefault();
                e.stopPropagation();

                const parentMega = this.closest('.mega-menu');
                const targetId = this.dataset.target;
                const wasActive = this.classList.contains('active');
                const isIndustriesMega = this.closest('.industries-mega');

                // Reset everything in this menu
                parentMega.querySelectorAll(
                    '.mega-left-item, .mega-center-content, .mega-right-content, .industry-panel'
                ).forEach(el => el.classList.remove('active'));

                // Toggle OFF
                if (wasActive) return;

                // Toggle ON
                this.classList.add('active');

                if (isIndustriesMega) {
                    const panel = parentMega.querySelector('#' + targetId);
                    if (panel) {
                        panel.classList.add('active');
                        this.insertAdjacentElement('afterend', panel);
                    }
                } else {
                    const center = parentMega.querySelector('#' + targetId);
                    const right = parentMega.querySelector('#' + targetId.replace('left-', 'right-'));

                    if (center) {
                        center.classList.add('active');
                        this.insertAdjacentElement('afterend', center);
                    }

                    if (right) {
                        right.classList.add('active');
                        center
                            ? center.insertAdjacentElement('afterend', right)
                            : this.insertAdjacentElement('afterend', right);
                    }
                }
            };
            
            item._mobileSubClickHandler = mobileSubClickHandler;
            item.addEventListener('click', mobileSubClickHandler);
        });
    };

    // Initialize mobile menu on page load if needed
    if (isMobile) {
        initMobileMenu();
    }

    /* ===============================
    5. SEARCH (DESKTOP & MOBILE)
    =============================== */
    
    // Handle DESKTOP search
    document.querySelectorAll('.mega-menu').forEach(megaMenu => {

        const input = megaMenu.querySelector('.mega-menu-search-input');
        const searchBtn = megaMenu.querySelector('.mega-search-btn');
        if (!input) return;

        let isSearchActive = false;

        // Update button appearance
        function updateSearchButton() {
            const hasValue = input.value.trim().length > 0;
            if (hasValue && searchBtn) {
                searchBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18M6 6l12 12" stroke="#007AC1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
            } else if (searchBtn) {
                searchBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="7" stroke="#007AC1" stroke-width="2"/><line x1="16.65" y1="16.65" x2="22" y2="22" stroke="#007AC1" stroke-width="2" stroke-linecap="round"/></svg>';
            }
        }

        // Button click handler
        if (searchBtn) {
            searchBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation(); // ← ADD THIS LINE to prevent menu from closing
                if (input.value.trim().length > 0) {
                    input.value = '';
                    clearTimeout(debounceTimer);
                    
                    megaMenu.querySelectorAll('.mega-center-content').forEach(panel => {
                        const list = panel.querySelector('.mega-menu-list');
                        if (list && panel._originalHTML) {
                            list.innerHTML = panel._originalHTML;
                        }
                    });
                    
                    restoreSidebarHighlight();
                    updateSearchButton();
                }
            });
        }

        // Cache original HTML per panel ONCE
        megaMenu.querySelectorAll('.mega-center-content').forEach(panel => {
            const list = panel.querySelector('.mega-menu-list');
            if (list && !panel._originalHTML) {
                panel._originalHTML = list.innerHTML;
            }
        });

        // Debounce timer
        let debounceTimer;

        input.addEventListener('input', () => {
            const q = input.value.trim();
            isSearchActive = q.length > 0;

            updateSearchButton();

            const activePanel = megaMenu.querySelector('.mega-center-content.active');
            if (!activePanel) return;

            const list = activePanel.querySelector('.mega-menu-list');
            if (!list) return;

            clearTimeout(debounceTimer);

            if (q.length === 0) {
                list.innerHTML = activePanel._originalHTML || '';
                restoreSidebarHighlight();
                return;
            }

            removeSidebarHighlight();
            list.innerHTML = '<li style="padding: 10px; color: #666;">Searching...</li>';

            debounceTimer = setTimeout(() => {
                performSearch(q, list, activePanel);
            }, 300);
        });

        function removeSidebarHighlight() {
            megaMenu.querySelectorAll('.mega-left-item').forEach(item => {
                item.classList.remove('active');
            });
        }

        function restoreSidebarHighlight() {
            if (window.innerWidth < 992) return;
            const activePanel = megaMenu.querySelector('.mega-center-content.active');
            if (activePanel) {
                const panelId = activePanel.id;
                const correspondingSidebarItem = megaMenu.querySelector(`.mega-left-item[data-target="${panelId}"]`);
                if (correspondingSidebarItem) {
                    correspondingSidebarItem.classList.add('active');
                }
            }
        }

        function performSearch(query, list, panel) {
            const lowerQuery = query.toLowerCase();
            let combinedResults = [];

            const allMenuItems = panel._originalHTML || panel.innerHTML;
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = allMenuItems;
            
            const menuLinks = tempDiv.querySelectorAll('a');
            menuLinks.forEach(link => {
                const text = link.textContent.trim();
                if (text.toLowerCase().includes(lowerQuery)) {
                    combinedResults.push({
                        title: text,
                        url: link.href || '#',
                        type: 'menu_item',
                        source: 'menu'
                    });
                }
            });

            const ajaxUrl = typeof ajax_object !== 'undefined' 
                ? ajax_object.ajax_url 
                : (typeof elsnerMega !== 'undefined' ? elsnerMega.ajaxUrl : '/wp-admin/admin-ajax.php');

            fetch(`${ajaxUrl}?action=elsner_mega_search&q=${encodeURIComponent(query)}`)
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return res.json();
                })
                .then(dbResults => {
                    if (dbResults && dbResults.length > 0) {
                        dbResults.forEach(item => {
                            item.source = 'database';
                            combinedResults.push(item);
                        });
                    }
                    displayResults(combinedResults, list);
                })
                .catch(error => {
                    console.error('Search error:', error);
                    if (combinedResults.length > 0) {
                        displayResults(combinedResults, list);
                    } else {
                        list.innerHTML = '<li style="padding: 10px; color: #d9534f;">Search failed. Please try again.</li>';
                    }
                });
        }

        function displayResults(results, list) {
            list.innerHTML = '';

            if (!results || results.length === 0) {
                list.innerHTML = '<li style="padding: 10px; color: #999;">No results found</li>';
                return;
            }

            const uniqueResults = results.filter((item, index, self) =>
                index === self.findIndex(t => t.title === item.title)
            );

            uniqueResults.slice(0, 10).forEach(item => {
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = item.url;
                
                const words = item.title.split(' ');
                const truncatedTitle = words.length > 5 
                    ? words.slice(0, 5).join(' ') + '...' 
                    : item.title;
                
                a.textContent = truncatedTitle;
                a.title = item.title;
                
                li.appendChild(a);
                list.appendChild(li);
            });
        }

        const parentMenuItem = megaMenu.closest('.menu-item');
        if (parentMenuItem) {
            parentMenuItem.addEventListener('mouseleave', () => {
                if (window.innerWidth >= 992) {
                    // Don't clear search on mouseleave - only clear when clicking outside
                    // clearSearchAndRestore(); // REMOVED
                }
            });
        }

        document.addEventListener('click', (e) => {
            if (!megaMenu.contains(e.target) && parentMenuItem && !parentMenuItem.contains(e.target)) {
                clearSearchAndRestore(); // This stays - clears when clicking outside
            }
        });

        megaMenu.querySelectorAll('.mega-left-item').forEach(leftItem => {
            leftItem.addEventListener('click', () => {
                if (window.innerWidth < 992) return;
                // Only clear search if the item doesn't have a link (submenu items)
                const hasLink = leftItem.dataset.hasLink === 'true';
                const href = leftItem.getAttribute('href');
                if (!hasLink || href === '#') {
                    clearSearchAndRestore();
                }
            });
        });

        function clearSearchAndRestore() {
            input.value = '';
            isSearchActive = false;
            clearTimeout(debounceTimer);
            
            megaMenu.querySelectorAll('.mega-center-content').forEach(panel => {
                const list = panel.querySelector('.mega-menu-list');
                if (list && panel._originalHTML) {
                    list.innerHTML = panel._originalHTML;
                }
            });
            
            restoreSidebarHighlight();
            updateSearchButton();
        }
    });

    // Handle MOBILE search
    const mobileSearchInput = document.querySelector('.mobile-search-bar-wrapper .mega-menu-search-input');
    const mobileSearchBtn = document.querySelector('.mobile-search-bar-wrapper .mega-search-btn');
    const mobileResultsContainer = document.querySelector('.mobile-search-results-wrapper');
    const navmenu = document.querySelector('ul.navmenu');

    if (mobileSearchInput && mobileResultsContainer) {
        let debounceTimer;

        function updateMobileSearchButton() {
            const hasValue = mobileSearchInput.value.trim().length > 0;
            if (hasValue && mobileSearchBtn) {
                mobileSearchBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18M6 6l12 12" stroke="#007AC1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
            } else if (mobileSearchBtn) {
                mobileSearchBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="7" stroke="#007AC1" stroke-width="2"/><line x1="16.65" y1="16.65" x2="22" y2="22" stroke="#007AC1" stroke-width="2" stroke-linecap="round"/></svg>';
            }
        }

        if (mobileSearchBtn) {
            mobileSearchBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (mobileSearchInput.value.trim().length > 0) {
                    mobileSearchInput.value = '';
                    mobileResultsContainer.classList.remove('show');
                    mobileResultsContainer.innerHTML = '';
                    if (navmenu) navmenu.style.display = 'flex';
                    updateMobileSearchButton();
                }
            });
        }

        mobileSearchInput.addEventListener('input', () => {
            const q = mobileSearchInput.value.trim();

            updateMobileSearchButton();
            clearTimeout(debounceTimer);

            if (q.length === 0) {
                mobileResultsContainer.classList.remove('show');
                mobileResultsContainer.innerHTML = '';
                if (navmenu) navmenu.style.display = 'flex';
                return;
            }

            if (navmenu) navmenu.style.display = 'none';

            mobileResultsContainer.classList.add('show');
            mobileResultsContainer.innerHTML = '<div style="padding: 20px; text-align: center; color: #666;">Searching...</div>';

            debounceTimer = setTimeout(() => {
                performMobileSearch(q);
            }, 300);
        });

        function performMobileSearch(query) {
            const lowerQuery = query.toLowerCase();
            let results = [];

            document.querySelectorAll('.mega-menu').forEach(menu => {
                menu.querySelectorAll('.mega-menu-list a').forEach(link => {
                    const text = link.textContent.trim();
                    if (text.toLowerCase().includes(lowerQuery)) {
                        results.push({
                            title: text,
                            url: link.href,
                            source: 'menu'
                        });
                    }
                });
            });

            const ajaxUrl = typeof ajax_object !== 'undefined' 
                ? ajax_object.ajax_url 
                : '/wp-admin/admin-ajax.php';

            fetch(`${ajaxUrl}?action=elsner_mega_search&q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(dbResults => {
                    if (dbResults && Array.isArray(dbResults) && dbResults.length > 0) {
                        dbResults.forEach(item => {
                            results.push({
                                title: item.title,
                                url: item.url,
                                source: 'database'
                            });
                        });
                    }
                    displayMobileResults(results);
                })
                .catch(error => {
                    console.error('Search error:', error);
                    displayMobileResults(results);
                });
        }

        function displayMobileResults(results) {
            if (!results || results.length === 0) {
                mobileResultsContainer.innerHTML = '<div style="padding: 20px; text-align: center; color: #999;">No results found</div>';
                return;
            }

            const uniqueResults = results.filter((item, index, self) =>
                index === self.findIndex(t => t.title === item.title)
            ).slice(0, 10);

            let html = '<ul style="list-style: none; padding: 0; margin: 0;">';
            uniqueResults.forEach(item => {
                html += `<li>
                            <a href="${item.url}" style="display: block; padding: 14px 20px; color: #333; text-decoration: none; font-size: 14px; font-weight: 400;">
                                ${item.title}
                            </a>
                        </li>`;
            });
            html += '</ul>';

            mobileResultsContainer.innerHTML = html;
        }

        updateMobileSearchButton();
    }

    // Enable menu after page fully loads
   window.addEventListener('load', function() {
       setTimeout(() => {
           isFullyLoaded = true;
           navbarToggler.disabled = false;
           document.documentElement.classList.remove('menu-loading');
       }, 300);
   });
   
   // Fallback if load takes too long
   setTimeout(() => {
       if (!isFullyLoaded) {
           isFullyLoaded = true;
           navbarToggler.disabled = false;
           document.documentElement.classList.remove('menu-loading');
       }
   }, 2000);

});