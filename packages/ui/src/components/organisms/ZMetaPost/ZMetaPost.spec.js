import { shallowMount } from '@vue/test-utils';
import ZMetaPost from './ZMetaPost.vue';

describe('ZMeta.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZMetaPost);
    expect(component.get('.z-meta'));
  });
});
