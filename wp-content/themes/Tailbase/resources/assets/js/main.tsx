import React from 'react';
import ReactDOM from 'react-dom';
import components from './components';


for (const container of Array.from(document.querySelectorAll('[data-react]'))) {
  if (container instanceof HTMLElement) {
    const componentName = container?.dataset?.react || null;
    const Component = components.find(c => c.name === componentName);

    const propsStr = container?.dataset?.props;
    let props = {};
    if (propsStr) {
      try {
        props = JSON.parse(propsStr);
      } catch {
        console.warn(`invalid props data property for ${componentName}`);
      }
    }

    if (Component) {
      ReactDOM.render(
        // @ts-ignore
        <Component {...props} />,
        container
      );
    }
  }
}
