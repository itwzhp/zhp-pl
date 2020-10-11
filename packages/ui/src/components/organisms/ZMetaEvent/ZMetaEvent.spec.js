import { shallowMount } from '@vue/test-utils';
import ZMetaEvent from './ZMetaEvent.vue';

describe('ZMetaEvent.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZMetaEvent);
    expect(component.get('.z-meta-event'));
  });
});
