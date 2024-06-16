function createConfirm(options) {
    // Create toast container element
    const toastContainer = document.createElement('div');
    toastContainer.id = 'toast-confirm';
    toastContainer.classList.add('z-50', 'fixed', 'right-5', 'top-5', 'w-full', 'max-w-xs', 'rounded-lg', 'bg-white', 'p-4', 'text-gray-500', 'shadow', 'dark:bg-gray-800', 'dark:text-gray-400');
    toastContainer.setAttribute('role', 'alert');

    // Create inner flex container
    const flexContainer = document.createElement('div');
    flexContainer.classList.add('flex');
    toastContainer.appendChild(flexContainer);

    // Icon container
    const iconContainer = document.createElement('div');
    iconContainer.classList.add('inline-flex', 'h-8', 'w-8', 'flex-shrink-0', 'items-center', 'justify-center', 'rounded-lg', 'bg-purple-100', 'text-purple-500', 'dark:bg-purple-900', 'dark:text-purple-300');
    flexContainer.appendChild(iconContainer);

    // Icon SVG
    const iconSVG = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    iconSVG.classList.add('h-5', 'w-5');
    iconSVG.setAttribute('aria-hidden', 'true');
    iconSVG.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
    iconSVG.setAttribute('width', '24');
    iconSVG.setAttribute('height', '24');
    iconSVG.setAttribute('fill', 'none');
    iconSVG.setAttribute('viewBox', '0 0 24 24');
    iconContainer.appendChild(iconSVG);

    const iconPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    iconPath.setAttribute('stroke', 'currentColor');
    iconPath.setAttribute('stroke-linecap', 'round');
    iconPath.setAttribute('stroke-linejoin', 'round');
    iconPath.setAttribute('stroke-width', '2');
    iconPath.setAttribute('d', 'M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z');
    iconSVG.appendChild(iconPath);

    // Title and subtitle container
    const textContainer = document.createElement('div');
    textContainer.classList.add('ms-3', 'text-sm', 'font-normal');
    flexContainer.appendChild(textContainer);

    // Title
    const titleSpan = document.createElement('span');
    titleSpan.id = 'toast-title';
    titleSpan.classList.add('mb-1', 'text-sm', 'font-semibold', 'text-gray-900', 'dark:text-white');
    titleSpan.textContent = options.title || 'Title';
    textContainer.appendChild(titleSpan);

    // Subtitle
    const subtitleDiv = document.createElement('div');
    subtitleDiv.id = 'toast-subtitle';
    subtitleDiv.classList.add('mb-2', 'text-sm', 'font-normal');
    subtitleDiv.textContent = options.subtitle || 'Subtitle';
    textContainer.appendChild(subtitleDiv);

    // Actions grid container
    const actionsGrid = document.createElement('div');
    actionsGrid.classList.add('grid', 'grid-cols-2', 'gap-2');
    textContainer.appendChild(actionsGrid);

    // Confirm button
    const confirmButton = document.createElement('button');
    confirmButton.id = 'confirm-button';
    confirmButton.type = 'button';
    confirmButton.classList.add('inline-flex', 'w-full', 'justify-center', 'rounded-lg', 'bg-purple-600', 'px-2', 'py-1.5', 'text-center', 'text-xs', 'font-medium', 'text-white', 'hover:bg-purple-700', 'focus:outline-none', 'focus:ring-4', 'focus:ring-purple-300', 'dark:bg-purple-500', 'dark:hover:bg-purple-600', 'dark:focus:ring-purple-800');
    confirmButton.textContent = options.confirmText || 'Confirm';
    actionsGrid.appendChild(confirmButton);

    // Not now button
    const notNowButton = document.createElement('button');
    notNowButton.id = 'not-now-button';
    notNowButton.type = 'button';
    notNowButton.classList.add('inline-flex', 'w-full', 'justify-center', 'rounded-lg', 'border', 'border-gray-300', 'bg-white', 'px-2', 'py-1.5', 'text-center', 'text-xs', 'font-medium', 'text-gray-900', 'hover:bg-gray-100', 'focus:outline-none', 'focus:ring-4', 'focus:ring-gray-200', 'dark:border-gray-600', 'dark:bg-gray-600', 'dark:text-white', 'dark:hover:border-gray-700', 'dark:hover:bg-gray-700', 'dark:focus:ring-gray-700');
    notNowButton.textContent = 'Tidak';
    actionsGrid.appendChild(notNowButton);

    // Event listeners
    confirmButton.addEventListener('click', function (event) {
        event.preventDefault();
        if (options.onConfirm && typeof options.onConfirm === 'function') {
            options.onConfirm();
        }
        removeToast('toast-confirm');
    });

    notNowButton.addEventListener('click', function (event) {
        event.preventDefault();
        removeToast('toast-confirm');
    });

    // Close button
    const closeButton = document.createElement('button');
    closeButton.id = 'close-button';
    closeButton.type = 'button';
    closeButton.classList.add('-mx-1.5', '-my-1.5', 'ms-auto', 'inline-flex', 'h-8', 'w-8', 'flex-shrink-0', 'items-center', 'justify-center', 'rounded-lg', 'bg-white', 'p-1.5', 'text-gray-400', 'hover:bg-gray-100', 'hover:text-gray-900', 'focus:ring-2', 'focus:ring-gray-300', 'dark:bg-gray-800', 'dark:text-gray-500', 'dark:hover:bg-gray-700', 'dark:hover:text-white');
    closeButton.setAttribute('data-dismiss-target', '#toast-confirm');
    closeButton.setAttribute('aria-label', 'Close');
    flexContainer.appendChild(closeButton);

    // Close button SVG
    const closeSVG = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    closeSVG.classList.add('h-3', 'w-3');
    closeSVG.setAttribute('aria-hidden', 'true');
    closeSVG.setAttribute('viewBox', '0 0 14 14');
    closeButton.appendChild(closeSVG);

    const closePath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    closePath.setAttribute('stroke', 'currentColor');
    closePath.setAttribute('stroke-linecap', 'round');
    closePath.setAttribute('stroke-linejoin', 'round');
    closePath.setAttribute('stroke-width', '2');
    closePath.setAttribute('d', 'm1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6');
    closeSVG.appendChild(closePath);

    closeButton.addEventListener('click', function (event) {
        event.preventDefault();
        removeToast('toast-confirm');
    });

    // Append toast container to the document body
    document.body.appendChild(toastContainer);

    if (options.timeout && typeof options.timeout === 'number') {
        setTimeout(() => {
            removeToast('toast-confirm');
        }, options.timeout);
    }
}

function createNotif(options) {
    // Create notification container
    const notificationContainer = document.createElement('div');
    notificationContainer.id = 'toast-notification';
    notificationContainer.classList.add('z-50', 'fixed', 'right-5', 'top-5', 'w-full', 'max-w-xs', 'p-4', 'text-gray-900', 'bg-white', 'rounded-lg', 'shadow', 'dark:bg-gray-800', 'dark:text-gray-300');
    notificationContainer.setAttribute('role', 'alert');

    // Create header container
    const headerContainer = document.createElement('div');
    headerContainer.classList.add('flex', 'items-center', 'mb-3');
    notificationContainer.appendChild(headerContainer);

    // Title span
    const titleSpan = document.createElement('span');
    titleSpan.classList.add('mb-1', 'text-sm', 'font-semibold', 'text-gray-900', 'dark:text-white');
    titleSpan.textContent = options.title || 'New notification';
    headerContainer.appendChild(titleSpan);

    // Close button
    const closeButton = document.createElement('button');
    closeButton.type = 'button';
    closeButton.classList.add('ms-auto', '-mx-1.5', '-my-1.5', 'bg-white', 'justify-center', 'items-center', 'flex-shrink-0', 'text-gray-400', 'hover:text-gray-900', 'rounded-lg', 'focus:ring-2', 'focus:ring-gray-300', 'p-1.5', 'hover:bg-gray-100', 'inline-flex', 'h-8', 'w-8', 'dark:text-gray-500', 'dark:hover:text-white', 'dark:bg-gray-800', 'dark:hover:bg-gray-700');
    closeButton.setAttribute('data-dismiss-target', '#toast-notification');
    closeButton.setAttribute('aria-label', 'Close');
    headerContainer.appendChild(closeButton);

    // Close button SVG
    const closeSVG = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    closeSVG.classList.add('w-3', 'h-3');
    closeSVG.setAttribute('aria-hidden', 'true');
    closeSVG.setAttribute('viewBox', '0 0 14 14');
    closeButton.appendChild(closeSVG);

    const closePath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    closePath.setAttribute('stroke', 'currentColor');
    closePath.setAttribute('stroke-linecap', 'round');
    closePath.setAttribute('stroke-linejoin', 'round');
    closePath.setAttribute('stroke-width', '2');
    closePath.setAttribute('d', 'm1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6');
    closeSVG.appendChild(closePath);

    closeButton.addEventListener('click', function (event) {
        event.preventDefault();
        removeToast('toast-notification');
    });

    // Create body container
    const bodyContainer = document.createElement('div');
    bodyContainer.classList.add('flex', 'items-center');
    notificationContainer.appendChild(bodyContainer);

    // Profile image and icon container
    const profileContainer = document.createElement('div');
    profileContainer.classList.add('relative', 'inline-block', 'shrink-0');
    bodyContainer.appendChild(profileContainer);

    // Profile image
    const profileImage = document.createElement('img');
    profileImage.classList.add('w-12', 'h-12', 'rounded-full', 'border');
    profileImage.src = options.imageSrc || '/docs/images/people/profile-picture-3.jpg';
    profileImage.alt = options.imageAlt || 'Profile picture';
    profileContainer.appendChild(profileImage);

    // Notification icon
    const iconSpan = document.createElement('span');
    iconSpan.classList.add('absolute', 'bottom-0', 'right-0', 'inline-flex', 'items-center', 'justify-center', 'w-4', 'h-4', 'bg-blue-600', 'rounded-full');
    profileContainer.appendChild(iconSpan);

    const iconSVG = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    iconSVG.classList.add('w-2', 'h-2', 'text-white');
    iconSVG.setAttribute('aria-hidden', 'true');
    iconSVG.setAttribute('viewBox', '0 0 20 18');
    iconSVG.setAttribute('fill', 'currentColor');
    iconSpan.appendChild(iconSVG);

    const iconPath1 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    iconPath1.setAttribute('d', 'M18 4H16V9C16 10.0609 15.5786 11.0783 14.8284 11.8284C14.0783 12.5786 13.0609 13 12 13H9L6.846 14.615C7.17993 14.8628 7.58418 14.9977 8 15H11.667L15.4 17.8C15.5731 17.9298 15.7836 18 16 18C16.2652 18 16.5196 17.8946 16.7071 17.7071C16.8946 17.5196 17 17.2652 17 17V15H18C18.5304 15 19.0391 14.7893 19.4142 14.4142C19.7893 14.0391 20 13.5304 20 13V6C20 5.46957 19.7893 4.96086 19.4142 4.58579C19.0391 4.21071 18.5304 4 18 4Z');
    iconSVG.appendChild(iconPath1);

    const iconPath2 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    iconPath2.setAttribute('d', 'M12 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V9C0 9.53043 0.210714 10.0391 0.585786 10.4142C0.960859 10.7893 1.46957 11 2 11H3V13C3 13.1857 3.05171 13.3678 3.14935 13.5257C3.24698 13.6837 3.38668 13.8114 3.55279 13.8944C3.71889 13.9775 3.90484 14.0126 4.08981 13.996C4.27477 13.9793 4.45143 13.9114 4.6 13.8L8.333 11H12C12.5304 11 13.0391 10.7893 13.4142 10.4142C13.7893 10.0391 14 9.53043 14 9V2C14 1.46957 13.7893 0.960859 13.4142 0.585786C13.0391 0.210714 12.5304 0 12 0Z');
    iconSVG.appendChild(iconPath2);

    // Text container
    const textContainer = document.createElement('div');
    textContainer.classList.add('ms-3', 'text-sm', 'font-normal');
    bodyContainer.appendChild(textContainer);

    // Text name
    const nameDiv = document.createElement('div');
    nameDiv.classList.add('text-sm', 'font-semibold', 'text-gray-900', 'dark:text-white');
    nameDiv.textContent = options.name || 'Bonnie Green';
    textContainer.appendChild(nameDiv);

    // Text content
    const contentDiv = document.createElement('div');
    contentDiv.classList.add('text-sm', 'font-normal');
    contentDiv.textContent = options.content || 'commented on your photo';
    textContainer.appendChild(contentDiv);

    // Timestamp
    const timestampSpan = document.createElement('span');
    timestampSpan.classList.add('text-xs', 'font-medium', 'text-blue-600', 'dark:text-blue-500');
    timestampSpan.textContent = options.timestamp || 'a few seconds ago';
    textContainer.appendChild(timestampSpan);

    // Append notification container to the document body
    document.body.appendChild(notificationContainer);

    if (options.timeout && typeof options.timeout === 'number') {
        setTimeout(() => {
            removeToast('toast-notification');
        }, options.timeout);
    }
}

function removeToast(id) {
    const toastContainer = document.getElementById(id);
    if (toastContainer) {
        toastContainer.remove();
    }
}

const Toast = {
    confirm: (options) => createConfirm(options),
    notif: (options) => createNotif(options)
};

export default Toast;

// Usage example
// Toast.confirm({
//     title: 'Custom Title',
//     subtitle: 'Custom Subtitle',
//     confirmText: 'Custom Confirm',
//     onConfirm: function () {
//         // Custom logic on confirm action
//         console.log('Confirm action executed.');
//     }
// });

// Toast.notif({
//     title: 'Notification Title',
//     imageSrc: '/path/to/image.jpg', // Customize the profile image
//     imageAlt: 'Profile image description',
//     name: 'Bonnie Green',
//     content: 'commented on your photo',
//     timestamp: 'a few seconds ago'
// });
