const driver = new Driver();

// Define the steps for introduction
driver.defineSteps([
  {
    element: '#handyKey',
    popover: {
      className: 'first-step-popover-class',
      title: 'Connection key',
      description: 'Enter your connection key and press the fist',
      position: 'bottom'
    }
  },
  {
    element: '#Offset',
    popover: {
      title: 'Offset',
      description: 'Set the offset of the script',
      position: 'top'
    }
  },
  {
    element: '#debugButton',
    popover: {
      title: 'Debug',
      description: 'Enable debug console.',
      position: 'right'
    }
  },
]);

// Start the introduction
driver.start();